<!--**********************************
        Sidebar start
***********************************-->
<style>
    li.active{
        background-color: #266C35;
    }

    li.active > a > i,
    li.active > a > span{
        color: #ffffff;
    }
</style>
<div class="dlabnav">
    <div class="dlabnav-scroll position-relative">
        <ul class="metismenu" id="menu">
            <li class="{{ (request()->route()->getName() == 'home')?"active":"" }}">
                <a href="{{ url('home') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Pricing management</span>
                </a>
            </li>
        </ul>
        <div class="copyright position-absolute bottom-0 mb-0">
            <p><strong>{{ env('APP_NAME') }}</strong> © {{ date('Y') }} All Rights Reserved</p>
            {{--<p>Made with <span class="heart"></span> by DexignLab</p>--}}
        </div>
    </div>
</div>

<!--**********************************
    Sidebar end
***********************************-->
