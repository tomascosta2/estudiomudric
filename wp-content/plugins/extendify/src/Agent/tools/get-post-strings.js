import apiFetch from '@wordpress/api-fetch';
import { parse } from '@wordpress/block-serialization-default-parser';

export const getPostStrings = async ({ postId, postType }) => {
	const type = postType === 'page' ? 'pages' : 'posts';
	const response = await apiFetch({
		path: `/wp/v2/${type}/${postId}?context=edit`,
	});
	const blocks = parse(response.content.raw);
	if (blocks.length < 2 && !blocks[0]?.blockName) {
		throw new Error('No blocks found in the post content');
	}
	return {
		post_strings: dedupeStrings([
			response.title.raw,
			...extractTextFromBlocks(blocks),
		]),
	};
};

const newSet = (arr) => new Set(arr.filter(Boolean));
const dedupeStrings = (arr) => [...newSet(arr)];

const stripHtml = (html) =>
	html
		.replace(/<[^>]+>/g, '')
		.replace(/\s+/g, ' ')
		.trim();

// Handles image stuff
const extractAltAndTitleFromHtml = (html) => {
	const matches = [];
	const altMatch = html.match(/alt="([^"]*)"/);
	if (altMatch && altMatch[1]) matches.push(altMatch[1].trim());
	const titleMatch = html.match(/title="([^"]*)"/);
	if (titleMatch && titleMatch[1]) matches.push(titleMatch[1].trim());
	return matches;
};

const extractTextFromBlocks = (blocks) =>
	blocks.flatMap((block) => [
		// Extract from innerContent (rendered HTML)
		...(block.innerContent
			? block.innerContent
					.filter(Boolean)
					.flatMap((html) => [
						stripHtml(html),
						...extractAltAndTitleFromHtml(html),
					])
					.filter(Boolean)
			: []),
		// Extract from relevant string attributes
		...['content', 'caption', 'alt', 'title', 'value']
			.map((key) =>
				typeof block.attrs?.[key] === 'string' ? block.attrs[key].trim() : null,
			)
			.filter(Boolean),
		// Recurse into innerBlocks
		...extractTextFromBlocks(block.innerBlocks || []),
	]);
