import { render } from '@shared/lib/dom';
import { LaunchPage } from '@launch/LaunchPage';
import '@launch/launch.css';

requestAnimationFrame(() => {
	const launch = document.getElementById('extendify-launch-page');
	if (!launch) return;
	render(<LaunchPage />, launch);
});
