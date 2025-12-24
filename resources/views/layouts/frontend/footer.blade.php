@php
    $footer_pages = App\Models\Menuitem::with(['subMenus.childMenus'])
        ->whereNull('parent_id')
        ->whereHas('get_menu', function ($query) {
            $query->where('location', 'footer1')->where('sourch', 'page');
        })
        ->orderby('position', 'asc')
        ->get();
    $footer_pages1 = App\Models\Menuitem::with(['subMenus.childMenus'])
        ->whereNull('parent_id')
        ->whereHas('get_menu', function ($query) {
            $query->where('location', 'footer2')->where('sourch', 'page');
        })
        ->orderby('position', 'asc')
        ->get();
@endphp

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 fade-in">
                <h5>Contact Us</h5>
                <p>
                    <strong>{{ get_setting('business_name')->value ?? '' }}</strong><br />
                    Mobile: {{ get_setting('phone')->value ?? '' }}<br />
                    {{ get_setting('email')->value ?? '' }}<br />
                    {{ get_setting('email2')->value ?? '' }}<br />
                    {{ get_setting('business_address')->value ?? '' }}
                </p>
            </div>
            <div class="col-md-4 fade-in delay-1">
                <h5>Service Hours</h5>
                <p>
                    Saturday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Sunday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Monday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Tuesday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Wednesday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Thursday: {{ get_setting('business_hours')->value ?? '' }}<br />
                    Friday: Closed
                </p>
            </div>
            <div class="col-md-4 fade-in delay-2">
                <h5>Quick Links</h5>
                <ul class="list-unstyled footer-menu">
                    @if (count($footer_pages) == 0)
                        @for ($i = 1; $i < 5; $i++)
                            <li><a href="#">Default Page {{ $i }}</a></li>
                        @endfor
                    @endif
                    @foreach ($footer_pages->take(5) as $key => $pages)
                        <li><a href="{{ route('footer.menu.page', $pages->url) }}">{{ $pages->title ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="copyright">
            <div class="copyright-content">
                <div class="copyright-text">
                    Copyright © {{ date('Y') }} | Powered by {{ get_setting('copy_right')->value ?? '' }}
                </div>
                <div class="developed-by">
                    Developed by {{ get_setting('developed_by')->value ?? '' }}
                </div>
            </div>
        </div>
    </div>
</footer>
