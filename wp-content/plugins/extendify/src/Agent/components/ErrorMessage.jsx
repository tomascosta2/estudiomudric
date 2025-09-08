export const ErrorMessage = ({ children }) => (
	<div className="mb-4 ml-10 mr-2 min-w-0 flex-1 flex-col gap-1 rtl:ml-2 rtl:mr-10 rtl:flex">
		<div className="flex gap-2 rounded-lg border border-wp-alert-red bg-wp-alert-red/10 p-3 text-red-800">
			<div>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					strokeWidth={1.5}
					stroke="currentColor"
					className="size-6">
					<path
						strokeLinecap="round"
						strokeLinejoin="round"
						d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
					/>
				</svg>
			</div>
			<div className="text-sm">{children}</div>
		</div>
	</div>
);
