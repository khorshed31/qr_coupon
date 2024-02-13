<style>
    .pay_disable{
        pointer-events: none;
    }
</style>


<div id="sidebar" class="sidebar responsive ace-save-state
main-sidebar sidebar-scroll sidebar-fixed" data-sidebar="true"
    data-sidebar-scroll="true" data-sidebar-hover="true">

    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>


    <ul class="nav nav-list">
        <li class="{{ request()->is('home') ? 'active' : '' }}">
            <a href="{{ url('home') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>



{{--        <li>--}}
{{--            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.smartsoftwarebd.dokani">--}}
{{--                <i class="menu-icon fa fa-mobile"></i>--}}
{{--                <span class="menu-text"> Smart Dokani App </span>--}}
{{--            </a>--}}

{{--            <b class="arrow"></b>--}}
{{--        </li>--}}


        @include('partials.sidebars.__sidebar_product')

        @foreach (session()->get('menu_modules') ?? [] as $menu)
            @php $sidebar_path = getSidebarName($menu) @endphp

            @if ($sidebar_path != '' && view()->exists($sidebar_path))
                {{-- @if ($sidebar_path != 'partials.sidebars.__sidebar_hospital')
                    @include($sidebar_path)
                @endif --}}
            @endif
        @endforeach

    </ul>

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
