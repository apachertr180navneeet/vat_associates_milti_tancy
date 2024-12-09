<style>
	span.app-brand-text.demo.menu-text.fw-bold.ms-2 {
		text-transform: capitalize;
	}
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{route('admin.dashboard')}}" class="app-brand-link">
			<span class="app-brand-logo demo">
			</span>
			<span class="app-brand-text demo menu-text fw-bold ms-2">Transport Admin</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : ''}}">
			<a href="{{route('admin.dashboard')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>

		<li class="menu-item {{ request()->is('transport/admin/branchs*') ? 'active' : ''}}">
            <a href="{{ route('admin.branchs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="User">Branchs</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('transport/admin/location*') ? 'active' : ''}}">
            <a href="{{ route('admin.location.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="User">Locations</div>
            </a>
        </li>

		<li class="menu-item {{ request()->is('transport/admin/bank*') ? 'active' : ''}}">
            <a href="{{ route('admin.bank.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="User">Bank</div>
            </a>
        </li>

	</ul>
</aside>
