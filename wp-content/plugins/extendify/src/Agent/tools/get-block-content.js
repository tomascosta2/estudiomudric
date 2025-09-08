import apiFetch from '@wordpress/api-fetch';
import { useWorkflowStore } from '@agent/state/workflows';

export const getBlockContent = async () => {
	const { block } = useWorkflowStore.getState();
	const { postId } = window.extAgentData.context;
	const response = await apiFetch({
		path: `/extendify/v1/agent/get-block-code?postId=${postId}&blockId=${block}`,
	});
	return { previousContent: response?.block ?? '' };
};
