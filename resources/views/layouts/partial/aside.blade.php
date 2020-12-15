<!--begin::Aside-->
<div class="aside aside-left d-flex  aside-fixed " id="kt_aside">

	<!--begin::Primary-->
	<div class="aside-primary d-flex flex-column align-items-center flex-row-auto">

		<!--begin::Brand-->
		<div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5 py-lg-12">

			<!--begin::Logo-->
			<a href="index.html">
				<img alt="Logo" src="{{asset('assets/media/logos/logo-letter-2.png')}}" class="max-h-50px" />
			</a>

			<!--end::Logo-->
		</div>

		<!--end::Brand-->

		<!--begin::Nav Wrapper-->
		<div class="aside-nav d-flex flex-column align-items-center flex-column-fluid py-5 scroll scroll-pull">

			<!--begin::Nav-->
			<ul class="nav flex-column" role="tablist">
				@if(auth()->check())
				@if(auth()->user()->isAdmin)
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="داشبورد">
					<a href="{{ route('admin.dashboard') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/dashboard') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
									<path
										d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
										fill="#000000" opacity="0.3" />
								</g>
							</svg>

							<!--end::Svg Icon--></span> </a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="کاربران">
					<a href="{{ route('admin.users.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/users*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path
										d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
										fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path
										d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
										fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>

							<!--end::Svg Icon--></span> </a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="کمپین های موقت">
					<a href="{{ route('admin.drafts.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/drafts*') ? 'active' : '' }}">

						<span class="svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Hidden.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path
										d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z"
										fill="#000000" fill-rule="nonzero" />
									<path
										d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z"
										fill="#000000" fill-rule="nonzero" />
									<rect fill="#000000" opacity="0.3"
										transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) "
										x="3.02462111" y="11.4246212" width="19" height="2" />
								</g>
							</svg>
							<!--end::Svg Icon--></span></a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="کمپین ها">
					<a href="{{ route('admin.campaigns.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/campaigns*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/General/Shield-check.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path
										d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
										fill="#000000" opacity="0.3" />
									<path
										d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
										fill="#000000" />
								</g>
							</svg>

							<!--end::Svg Icon--></span> </a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="ناشران">
					<a href="{{ route('admin.publishers.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/publishers*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Media/Airplay-video.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path
										d="M7,15 C7.55228475,15 8,15.4477153 8,16 C8,16.5522847 7.55228475,17 7,17 L6,17 C4.34314575,17 3,15.6568542 3,14 L3,7 C3,5.34314575 4.34314575,4 6,4 L18,4 C19.6568542,4 21,5.34314575 21,7 L21,14 C21,15.6568542 19.6568542,17 18,17 L17,17 C16.4477153,17 16,16.5522847 16,16 C16,15.4477153 16.4477153,15 17,15 L18,15 C18.5522847,15 19,14.5522847 19,14 L19,7 C19,6.44771525 18.5522847,6 18,6 L6,6 C5.44771525,6 5,6.44771525 5,7 L5,14 C5,14.5522847 5.44771525,15 6,15 L7,15 Z"
										fill="#000000" fill-rule="nonzero" />
									<polygon fill="#000000" opacity="0.3" points="8 20 16 20 12 15" />
								</g>
							</svg>
							<!--end::Svg Icon--></span></a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="دسته بندی ها">
					<a href="{{ route('admin.categories.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/categories*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path
										d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
										fill="#000000" />
									<path
										d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
										fill="#000000" opacity="0.3" />
								</g>
							</svg>
							<!--end::Svg Icon--></span></a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="برند ها">
					<a href="{{ route('admin.brands.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/brands*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Devices/Generator.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" opacity="0.3" x="2" y="6" width="20" height="14" rx="2" />
									<path
										d="M5,4 L7,4 C7.55228475,4 8,4.44771525 8,5 L8,6 L4,6 L4,5 C4,4.44771525 4.44771525,4 5,4 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,6 L16,6 L16,5 C16,4.44771525 16.4477153,4 17,4 Z"
										fill="#000000" />
									<path
										d="M7,12 L7,11 C7,10.4477153 7.44771525,10 8,10 C8.55228475,10 9,10.4477153 9,11 L9,12 L10,12 C10.5522847,12 11,12.4477153 11,13 C11,13.5522847 10.5522847,14 10,14 L9,14 L9,15 C9,15.5522847 8.55228475,16 8,16 C7.44771525,16 7,15.5522847 7,15 L7,14 L6,14 C5.44771525,14 5,13.5522847 5,13 C5,12.4477153 5.44771525,12 6,12 L7,12 Z"
										fill="#000000" />
									<rect fill="#000000" x="14" y="12" width="4" height="2" rx="1" />
								</g>
							</svg>
							<!--end::Svg Icon--></span></a>
				</li>
                        <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                            data-boundary="window" title="گزارش ها">
                            <a href="{{ route('admin.stat.index') }}"
                               class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('admin/stat*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Devices/Generator.svg-->
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                <title>Stockholm-icons / Devices / Display1</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Stockholm-icons-/-Devices-/-Display1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                    <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                    <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" id="Combined-Shape" fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span></a>
                        </li>
				@else
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="داشبورد">
					<a href="{{ route('dashboard') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('dashboard') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
									<path
										d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
										fill="#000000" opacity="0.3" />
								</g>
							</svg>

							<!--end::Svg Icon--></span> </a>
				</li>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
					data-boundary="window" title="کمپین ها">
					<a href="{{ route('campaigns.index') }}"
						class="nav-link btn btn-icon btn-clean btn-lg {{ request()->is('campaigns*') ? 'active' : '' }}">
						<span class="svg-icon svg-icon-xl">

							<!--begin::Svg Icon | path:assets/media/svg/icons/General/Shield-check.svg--><svg
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path
										d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
										fill="#000000" opacity="0.3" />
									<path
										d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
										fill="#000000" />
								</g>
							</svg>

							<!--end::Svg Icon--></span></a>
				</li>
				@endif
				@endif
			</ul>

			<!--end::Nav-->
		</div>

		<!--end::Nav Wrapper-->

		<!--begin::Footer-->
		<div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">
			<!--begin::User-->
			<a href="javascript:;"
				class="btn btn-icon btn-clean btn-lg w-40px h-40px {{ request()->is('profile*') ? 'active' : '' }}"
				id="kt_quick_user_toggle" data-toggle="tooltip" data-placement="right" data-container="body"
				data-boundary="window" title="اطلاعات کاربر">
				<span class="symbol symbol-30 symbol-lg-40">
					<span class="svg-icon svg-icon-xl">

						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg--><svg
							xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
							height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path
									d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
									fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path
									d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
									fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>

						<!--end::Svg Icon--></span>

					<!--<span class="symbol-label font-size-h5 font-weight-bold">S</span>-->
				</span>
			</a>

			<!--end::User-->
		</div>

		<!--end::Footer-->
	</div>

	<!--end::Primary-->
</div>

<!--end::Aside-->
