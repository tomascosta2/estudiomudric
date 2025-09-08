import changeThemeVariation from '@agent/workflows/change-theme-variation';
import editBlockContent from '@agent/workflows/edit-block-content';
import editPostStrings from '@agent/workflows/edit-post-strings';
import editPostStringsEditor from '@agent/workflows/edit-post-strings-editor';
import listOfTours from '@agent/workflows/get-list-of-tours';

export const workflows = [
	editPostStrings,
	editPostStringsEditor,
	changeThemeVariation,
	listOfTours,
	editBlockContent,
];
