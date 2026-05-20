
            <ul class="menu-inner py-1">
                @foreach ($items as $item)
                  <li class="menu-item">
                    <a href="{{ route($item['route']) }}" class="menu-link">
                      <i class="menu-icon icon-base ri {{ $item['icon'] }}"></i>
                      <div data-i18n="{{ $item['name'] }}">{{ $item['name'] }}</div>
                    </a>
                  </li>
                @endforeach
              <!-- Dashboards -->
              <li class="menu-item active open">
                <a href="{{ route('dashboard.dashboard') }}" class="menu-link">
                  <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                  <div data-i18n="Dashboards">Dashboards</div>
                  {{-- <div class="badge text-bg-danger rounded-pill ms-auto">5</div> --}}
                </a>
  
              </li>
              <li class="menu-item">
                <a href="{{ route('dashboard.categories.index') }}" class="menu-link">
                  <i class="menu-icon icon-base ri ri-table-alt-line"></i>
                  <div data-i18n="Categories">Categories</div>
                </a>
              </li>

            </ul>
          