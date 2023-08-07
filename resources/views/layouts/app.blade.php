<x-layouts.base>


    @if (in_array(request()->route()->getName(),
            [
                'dashboard',
                'employees',
                'employees.edit',
                'employees.addNew',
                'employees.lateness',
                'employees.overtime',
                'attendences',
                'leaves',
                'vacations',
                'schedule',
                'schedule.set',
                'deductions',
                'allownces',
                'salaries',
                'profile',
                'permissions',
                'permissions.edit',
                'permissions.roles',
                'permissions.role.edit',
                'roles',
                'role.addNew',
                'profile-example',
                'users',
                'bootstrap-tables',
                'transactions',
                'buttons',
                'forms',
                'modals',
                'notifications',
                'typography',
                'upgrade-to-pro',
            ]))
        {{-- Nav --}}
        @include('layouts.nav')
        {{-- SideNav --}}
        @include('layouts.sidenav')
        <main class="content">
            {{-- TopBar --}}
            @include('layouts.topbar')
            {{ $slot }}
            {{-- Footer --}}
            @include('layouts.footer')
        </main>
    @elseif(in_array(request()->route()->getName(),
            [
                'register',
                'register-example',
                'login',
                'login-example',
                'forgot-password',
                'forgot-password-example',
                'reset-password',
                'reset-password-example',
            ]))
        {{ $slot }}
        {{-- Footer --}}
        @include('layouts.footer2')
    @elseif(in_array(request()->route()->getName(),
            ['404', '500', 'lock']))
        {{ $slot }}
    @endif
</x-layouts.base>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3D2FJ9N4TM">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3D2FJ9N4TM');
</script>