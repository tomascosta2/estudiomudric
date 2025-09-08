import apiFetch from '@wordpress/api-fetch';
import { create } from 'zustand';
import { persist, devtools, createJSONStorage } from 'zustand/middleware';
import { makeId } from '@agent/lib/util';

const { chatHistory } = window.extAgentData;
const state = (set, get) => ({
	messagesRaw: (chatHistory || []).toReversed(),
	messages: chatHistory?.length
		? chatHistory
				// Remove some noise on reload
				.filter(
					(message) =>
						!['agent-working', 'calling-agent', 'tool-started'].includes(
							message.details?.type,
						) && !['workflow'].includes(message.type),
				)
				.toReversed()
		: [],

	seenAgents: [],
	// Messages sent to the api, user and assistant only. Up until the last workflow
	getMessagesForChat: () => {
		const messages = [];
		let foundUserMessage = false;
		for (const msg of get().messagesRaw.toReversed()) {
			const finished = ['completed', 'canceled'].includes(msg.details.status);
			if (msg.type === 'workflow' && finished) break;
			if (msg.type === 'workflow-component' && finished) break;
			// This prevents a loop of assistant messages from being at the end
			if (msg.type === 'message' && msg.details.role === 'user') {
				foundUserMessage = true;
			}
			if (msg.type === 'message' && !foundUserMessage) continue;
			if (msg.type === 'message') messages.push(msg.details);
		}
		return messages.toReversed();
	},
	hasMessages: () => get().messages.length > 0,
	addMessage: (type, details) => {
		const id = makeId();
		// If there's an agent, check if seen before
		if (details?.agent?.name) {
			const seenAgents = get().seenAgents;
			if (!seenAgents.includes(details.agent.name)) {
				details.firstSeen = true;
				const seen = (state) =>
					new Set([...state.seenAgents, details.agent.name]);
				set((state) => ({
					seenAgents: [...seen(state)],
				}));
			}
		}
		set((state) => {
			// max 150 messages
			const max = Math.max(0, state.messages.length - 149);
			const next = { id, type, details };
			return {
				// { id: 1, type: message, details: { role: 'user', content: 'Hello' } }
				// { id: 2, type: message, details: { role: 'assistant', content: 'Hi there!' } }
				// { id: 3, type: workflow, details: { name: 'Workflow 1' } }
				// { id: 5, type: status, details: { type: 'calling-agent' }
				messages: [...state.messages.toSpliced(0, max), next],
				messagesRaw: [...state.messagesRaw.toSpliced(0, max), next],
			};
		});
		return id;
	},
	clearMessages: () => set({ messages: [] }),
});

const path = '/extendify/v1/agent/chat-events';
const storage = {
	getItem: async () => await apiFetch({ path }),
	setItem: async (_name, state) =>
		await apiFetch({ path, method: 'POST', data: { state } }),
};

export const useChatStore = create()(
	persist(devtools(state, { name: 'Extendify Agent Chat' }), {
		name: 'extendify-agent-chat',
		storage: createJSONStorage(() => storage),
		skipHydration: true,
	}),
);
