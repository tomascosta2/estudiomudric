import { AI_HOST } from '@constants';
import { useChatStore } from '@agent/state/chat';
import { useWorkflowStore } from '@agent/state/workflows';
import { getBlockContent } from '@agent/tools/get-block-content';
import { getPostStrings } from '@agent/tools/get-post-strings';
import { getPostStringsEditor } from '@agent/tools/get-post-strings-editor';
import { getThemeVariations } from '@agent/tools/get-theme-variations';
import { searchWpDocs } from '@agent/tools/search-wp-docs';
import { updateBlockContent } from '@agent/tools/update-block-content';
import { updatePostStrings } from '@agent/tools/update-post-strings';
import { updatePostStringsEditor } from '@agent/tools/update-post-strings-editor';
import { updateThemeVariation } from '@agent/tools/update-theme-variation';

const tools = {
	'search-wp-docs': searchWpDocs,
	'get-post-strings': getPostStrings,
	'get-post-strings-editor': getPostStringsEditor,
	'update-post-strings': updatePostStrings,
	'update-post-strings-editor': updatePostStringsEditor,
	'get-theme-variations': getThemeVariations,
	'update-theme-variation': updateThemeVariation,
	'get-block-content': getBlockContent,
	'update-block-content': updateBlockContent,
};

const extraBody = {
	...Object.fromEntries(
		Object.entries(window.extSharedData).filter(([key]) =>
			// Optionally add items to request body
			[
				'partnerId',
				'devbuild',
				'version',
				'siteId',
				'wpLanguage',
				'wpVersion',
				'siteProfile',
			].includes(key),
		),
	),
};

export const pickWorkflow = async ({ workflows, options }) => {
	const { failedWorkflows, context } = window.extAgentData;
	const failed = failedWorkflows ?? new Set();
	const filteredWorkflows = workflows.filter((wf) => !failed.has(wf.id));

	const pastWorkflows = useWorkflowStore.getState().workflowHistory;
	const messages = useChatStore.getState().getMessagesForChat();

	const response = await fetch(`${AI_HOST}/api/agent/find-agent`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			...extraBody,
			workflows: filteredWorkflows,
			workflowHistory: pastWorkflows
				.filter(Boolean)
				.slice(0, 5)
				.filter((h) => h.summary)
				.map((h) => h.summary),
			previousAgentName: pastWorkflows.at(0)?.agentName,
			context,
			messages: messages.slice(-5),
			...options,
		}),
	}).catch((error) => digest({ caller: 'pick-workflow', error }));

	if (!response.ok) {
		const error = new Error('Bad response from server');
		error.response = response;
		throw error;
	}
	return await response.json();
};

export const handleWorkflow = async ({ workflow, workflowData }) => {
	const messages = useChatStore.getState().getMessagesForChat();
	const response = await fetch(`${AI_HOST}/api/agent/handle-workflow`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			...extraBody,
			workflow,
			workflowData,
			messages: messages,
			context: window.extAgentData.context,
		}),
	}).catch((error) => {
		throw error;
	});

	if (!response.ok) throw new Error('Bad response from server');
	return await response.json();
};

export const rateAnswer = ({ answerId, rating }) =>
	fetch(`${AI_HOST}/api/agent/rate-workflow`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({ answerId, rating }),
	}).catch((error) =>
		digest({
			caller: 'rateAnswer',
			error,
			extra: { answerId, rating },
		}),
	);

export const callTool = async ({ tool, inputs }) => {
	if (!tools[tool]) throw new Error(`Tool ${tool} not found`);
	return await tools[tool](inputs);
};

export const digest = ({ error, sessionId, caller, extra = {} }) => {
	if (Boolean(extraBody?.devbuild) === true) return;

	const errorMessage = () => {
		if (error.response && error.response.statusText) {
			return (
				error.response?.statusText || error.response.message || 'Unknown error'
			);
		}
		return typeof error === 'string'
			? error
			: error?.message || 'Unknown error';
	};

	const errorData = {
		message: errorMessage(),
		name: error?.name,
	};

	return fetch(`${AI_HOST}/api/agent/digest`, {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			...extraBody,
			phpVersion: window.extSharedData?.phpVersion,
			sessionId,
			error: errorData,
			browser: {
				userAgent: window.navigator?.userAgent,
				vendor: window.navigator?.vendor,
				platform: window.navigator?.platform,
				width: window.innerWidth,
				height: window.innerHeight,
				touchSupport: 'ontouchstart' in window || navigator.maxTouchPoints > 0,
			},
			caller,
			...extra,
		}),
	}).catch(() => {});
};
