<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->

 
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
    @hasanyrole('Admin|Accountant')
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @endhasanyrole
      @hasrole('Admin')
      <li class="@if ($activePage == 'user') active @endif">
              <a href="{{ route('users.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("User Management") }} </p>
              </a>
            </li>
            @endhasrole

      <li class = "@if ($activePage == 'order') active @endif">
        <a href="{{ route('orders.index') }}">
          <i class="now-ui-icons location_map-big"></i>
          <p>{{ __('ORDERS') }}</p> 
        </a>
      </li>
      @hasanyrole('Admin|Designer')
      <li class = "@if ($activePage == 'art') active @endif">
        <a href="{{ route('posts.index',) }}">
          <i class="now-ui-icons location_map-big"></i>
          <p>{{ __('Art Workspace') }}</p> 
        </a>
      </li>
      @endhasanyrole
      
      @hasanyrole('Admin|Accountant')
      <li class = " @if ($activePage == 'completed') active @endif">
        <a href="{{ route('completed') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Completed Artworks') }}</p>
        </a>
      </li>
      @endhasanyrole

      @hasanyrole('Admin|Accountant')
      <li class = " @if ($activePage == 'invoice') active @endif">
        <a href="{{ route('invoice.index') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Invoice') }}</p>
        </a>
      </li>
      @endhasanyrole
      <!-- <li class = "">
        <a href="{{ route('page.index','upgrade') }}" class="bg-info">
          <i class="now-ui-icons arrows-1_cloud-download-93"></i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> -->
    </ul>
  </div>
</div>
