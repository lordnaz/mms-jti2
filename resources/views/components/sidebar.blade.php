@php
$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],
    [
        "href" => [
            [
                "section_text" => "User",
                "section_list" => [
                    ["href" => "user", "text" => "Data User"],
                    ["href" => "user.new", "text" => "Buat User"]
                ]
            ]
        ],
        "text" => "User",
        "is_multi" => true,
    ],
];
$navigation_links = array_to_object($links);

@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="./img/symbol.png" alt="">
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-header">Task</li>
            
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Task List</span></a>
            </li>

        </ul>

        <ul class="sidebar-menu">
            <li class="menu-header">Operation</li>
            
            <li class="{{ Request::routeIs('manpower') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manpower') }}"><i class="fas fa-user-plus"></i><span>Manpower</span></a>
            </li>

            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-truck"></i><span>Transportation</span></a>
            </li>
        </ul>
    </aside>
</div>
