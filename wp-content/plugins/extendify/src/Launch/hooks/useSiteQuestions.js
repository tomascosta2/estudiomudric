import useSWRImmutable from 'swr/immutable';
import { getSiteQuestions } from '@launch/api/DataApi';
import { useSiteProfile } from '@launch/hooks/useSiteProfile';

export const useSiteQuestions = ({ disableFetch = false } = {}) => {
	const { siteProfile, loading: profileLoading } = useSiteProfile();

	const { data, error } = useSWRImmutable(
		profileLoading || !siteProfile || disableFetch
			? null
			: {
					key: 'site-questions',
					siteProfile,
				},
		getSiteQuestions,
	);

	return {
		questions: data,
		error,
		loading: profileLoading || (!data && !error),
	};
};
