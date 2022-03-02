<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/vue.js') }}" defer></script>

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    {{-- Braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- TomTom -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
</head>
<body>
    <div class="bg-primary full-height d-flex flex-column">
       <header class="d-flex align-items-center justify-content-between">
            <div class="logo-container d-flex align-items-center p-3">
                <h1 class="mb-0 mx-3 ml-0 text-white logo-text">Slothel</h1>
                <svg
                width="65"
                height="60"
                viewBox="0 0 65 60"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                    d="M23.9542 13.6103L19.9228 13.2581C19.5606 14.2403 19.3304 15.2113 18.8767 16.0391C17.8515 17.9207 16.2614 18.9155 14.2189 19.0488C13.3741 19.1035 13.0629 18.7527 13.1361 17.8393C13.2826 16.0026 13.9979 14.4816 15.3513 13.3227C15.5134 13.1824 15.669 13.0336 15.9201 12.8049C14.2202 12.5243 12.6262 12.3237 11.0557 12.0052C7.99581 11.3878 4.94466 10.733 1.90223 10.0408C0.615512 9.74614 -0.203069 8.35004 0.0493053 7.09425C0.350062 5.59151 1.48771 4.70895 2.88295 4.97274C4.33966 5.25336 5.7846 5.60414 7.23477 5.92124C7.43615 5.96474 7.64144 5.98719 7.82451 6.01525C7.50807 5.1341 7.10401 4.33853 6.94186 3.48965C6.58487 1.62912 6.81109 1.11417 8.66663 1.46355C10.8896 1.88448 12.8118 3.81236 13.2734 6.23414C13.3885 6.84449 13.5572 7.12512 14.1888 7.18826C17.5219 7.52501 20.8564 7.93051 24.1909 8.27848C24.3844 8.29952 24.7035 8.061 24.8003 7.85754C25.7496 5.82443 27.256 4.70755 29.377 4.75526C31.5254 4.80436 33.0174 5.97035 33.8687 8.10028C33.9472 8.29391 34.2388 8.52122 34.4218 8.52122C37.5331 8.38091 40.6431 8.213 43.7518 8.0175C43.9637 8.00347 44.2514 7.75792 44.3507 7.54044C45.9199 4.06492 50.1906 3.44475 52.5156 6.38989C52.7981 6.74768 53.057 6.85432 53.4623 6.76873C54.2835 6.59474 55.1113 6.45443 55.8279 6.31973C55.1492 5.38525 54.3764 4.54479 53.8664 3.54998C53.4872 2.80493 53.3852 1.86624 53.2819 1.00333C53.2087 0.280722 53.5696 -0.0153355 54.2469 9.88105e-05C56.7406 0.0604328 59.0067 1.97148 59.6684 4.57145C59.7364 4.83804 59.8057 5.10323 59.8894 5.43015C60.6844 5.26318 61.4428 5.06955 62.2104 4.94748C62.8315 4.85125 63.4633 5.01532 63.9746 5.40566C64.4859 5.79599 64.8375 6.3826 64.9565 7.04374C65.1735 8.28128 64.5315 9.59881 63.3873 9.91732C61.4716 10.4505 59.5298 10.8756 57.5932 11.3204C56.4045 11.5898 55.2041 11.8017 53.9488 12.0529C54.0678 13.2974 54.1829 14.4985 54.2966 15.701C54.7896 20.9065 55.378 26.098 55.752 31.319C56.0959 36.098 55.1636 40.6652 53.1197 44.9447C52.8948 45.4133 52.8739 45.7374 53.189 46.1935C54.7831 48.5044 54.6078 51.8157 52.8242 53.9653C50.9935 56.1612 47.9507 56.7435 45.6165 55.2941C45.2046 55.0387 44.9418 55.078 44.5704 55.3488C41.5066 57.6036 38.1408 59.1204 34.465 59.676C26.5446 60.8714 19.4638 58.7738 13.4369 53.0379C8.9007 48.7247 6.13635 43.2932 5.27724 36.8627C4.96923 34.4337 4.9096 31.9758 5.0994 29.5329C5.42631 25.0331 9.33091 21.1815 13.5363 20.9346C17.2412 20.7176 20.125 22.2685 22.1876 25.5873C22.2687 25.7164 22.3641 25.8357 22.5799 26.1331C23.0467 21.862 23.4952 17.7804 23.9542 13.6103ZM50.6182 46.1191C47.9729 44.8044 45.7944 42.8919 44.1938 40.2611C42.614 37.6749 41.7639 34.654 41.7459 31.5618H36.5154C36.2342 33.2118 36.1035 34.8366 35.6706 36.3618C34.3473 41.03 31.528 44.3596 27.3894 46.3506C25.6122 47.2034 23.6897 47.652 21.743 47.6681C21.0892 47.6766 20.74 47.4072 20.7374 46.8613C20.7374 46.1893 21.1415 45.99 21.6815 45.9591C21.9208 45.9451 22.1601 45.917 22.3981 45.903C29.8085 45.4554 35.5124 38.162 34.6664 30.2471C34.2414 26.2762 33.87 22.2984 33.4647 18.3206C33.1574 15.2997 32.8435 12.2872 32.5022 9.26346C32.4552 8.84253 32.2342 8.44966 32.0929 8.04275L31.8667 8.1087C31.8667 9.24522 31.8667 10.3817 31.8667 11.5183C31.8667 12.015 31.6993 12.3503 31.1933 12.3335C30.7068 12.318 30.6062 11.9645 30.6088 11.5099C30.6192 10.1067 30.597 8.70362 30.6205 7.30051C30.631 6.65648 30.359 6.47828 29.751 6.58492V7.35663C29.751 8.7373 29.7431 10.1166 29.751 11.4972C29.751 11.9925 29.5993 12.3391 29.0971 12.3391C28.595 12.3391 28.4891 11.9771 28.4891 11.5323C28.4891 10.1516 28.4891 8.77237 28.4891 7.39171C28.4891 7.14476 28.4656 6.89781 28.4512 6.63262C27.8523 6.6663 27.6077 6.91325 27.6195 7.51518C27.647 8.89445 27.6195 10.2751 27.6195 11.6558C27.6195 12.0767 27.4273 12.3237 27.0324 12.3405C26.6375 12.3573 26.4152 12.1455 26.3916 11.7189C26.3733 11.3681 26.3642 11.0174 26.3616 10.668C26.3616 10.0885 26.3616 9.50761 26.3616 8.92672L26.1524 8.91128C26.0909 9.26767 26.0124 9.62266 25.9719 9.98186C25.7274 12.1862 25.4933 14.3933 25.2514 16.5975C24.8329 20.4056 24.4184 24.2123 23.9869 28.0175C23.7764 29.8724 23.7149 31.7764 23.2664 33.5654C21.4226 40.9051 12.7308 43.3255 7.71467 37.96C7.4963 37.7271 7.28838 37.4829 6.99547 37.1518C8.0272 45.3207 14.3836 55.1271 25.237 57.7004C36.2669 60.3116 46.1003 54.3161 50.6182 46.1191ZM46.0507 8.31356L45.8218 8.25743C45.7227 8.52825 45.6448 8.80752 45.5891 9.09229C45.4086 10.5983 45.2408 12.1043 45.0856 13.6103C44.6672 17.6793 44.2409 21.7414 43.8551 25.8104C43.6551 27.9221 43.3504 30.0492 43.4158 32.1581C43.5675 36.9652 45.6558 40.7171 49.3459 43.4181C49.9997 43.8952 50.7294 44.2403 51.412 44.6402C52.938 42.0922 54.2561 37.1265 54.1868 33.7352C54.1332 31.1001 53.9501 28.4623 53.7095 25.8385C53.2113 20.421 52.6438 15.0092 52.0841 9.59741C52.0331 9.10491 51.8356 8.63066 51.7062 8.14799L51.4957 8.20692C51.4957 9.39676 51.5074 10.5852 51.4957 11.7736C51.4865 12.4415 51.004 12.8218 50.5803 12.4752C50.3842 12.3195 50.2717 11.9238 50.2652 11.6333C50.2338 10.1615 50.2272 8.68678 50.2573 7.21492C50.2717 6.56808 50.0416 6.31271 49.3877 6.37305V7.13775C49.3877 8.70502 49.3877 10.2723 49.3877 11.8382C49.3877 12.2914 49.2008 12.5397 48.7692 12.5594C48.3377 12.579 48.1847 12.3068 48.1533 11.9055C48.135 11.6726 48.1259 11.4397 48.1246 11.204C48.1246 9.84856 48.1246 8.49175 48.1246 7.13494C48.1246 6.8908 48.0945 6.64666 48.0788 6.40532C47.4668 6.35902 47.2942 6.59614 47.3073 7.18545C47.3491 8.58857 47.323 9.99168 47.3191 11.3948C47.3191 11.6039 47.3596 11.869 47.2602 12.0094C47.1007 12.2353 46.8562 12.4892 46.6169 12.5313C46.2102 12.6015 46.0664 12.2507 46.0664 11.8536C46.0576 10.6769 46.0524 9.49685 46.0507 8.31356ZM43.4955 13.4447L34.6402 13.926C34.6611 14.1912 34.6742 14.3975 34.6938 14.6009C34.8847 16.5063 35.0765 18.4118 35.2692 20.3172C35.5673 23.2441 35.8786 26.1696 36.1597 29.0993C36.2133 29.6605 36.4016 29.843 36.9325 29.8275C38.2833 29.7882 39.6367 29.7756 40.9862 29.8275C41.6478 29.8556 41.878 29.6451 41.946 28.9239C42.2951 25.1804 42.6966 21.4439 43.0771 17.699C43.2183 16.3183 43.3504 14.9278 43.4955 13.4447ZM17.2774 30.6091C17.3585 30.9963 17.3376 31.2811 17.4605 31.4173C18.2856 32.3405 17.6749 33.5009 16.5988 33.5809C15.0884 33.6917 13.5663 33.6258 12.0508 33.6075C11.8259 33.6075 11.5892 33.4672 11.3813 33.3493C10.7105 32.9621 10.5875 32.2633 11.006 31.5786C11.1498 31.3443 11.1917 31.0384 11.3067 30.6848C9.72712 31.0089 7.99451 32.3138 7.3093 33.6328C7.26122 33.7277 7.23188 33.8323 7.22311 33.94C7.21433 34.0476 7.22631 34.1561 7.25831 34.2586C8.66663 37.3889 11.0217 39.119 14.2411 39.1428C17.4605 39.1667 19.8469 37.4984 21.2827 34.3722C21.3314 34.2395 21.3529 34.0972 21.3456 33.9548C21.3384 33.8124 21.3027 33.6734 21.2409 33.5472C20.3308 32.0557 18.9996 31.1871 17.2774 30.6091ZM6.8974 29.0179C7.83497 28.3977 8.79086 27.6653 9.8265 27.1041C11.2819 26.3155 12.5725 27.2275 12.5961 28.9828C12.6065 29.6058 12.5961 30.2274 12.5961 30.8588H16.0116C16.0116 30.1573 15.9946 29.4824 16.0116 28.8117C16.0587 27.3089 17.2735 26.4109 18.5615 26.9988C19.3343 27.3524 20.0509 27.8632 20.7649 28.35C21.1206 28.5928 21.4187 28.9393 21.7848 29.2845C21.3141 25.6154 18.045 22.4836 14.1221 22.6015C9.68659 22.7306 7.00201 26.62 6.8974 29.0179ZM24.1046 11.8901C24.1556 11.5688 24.1974 11.3401 24.2288 11.1114C24.3844 9.95941 24.3792 10.0099 23.2925 9.90469C20.4157 9.62406 17.5115 9.41921 14.653 8.95197C10.7222 8.30935 6.8124 7.45485 2.89603 6.68594C2.20821 6.54563 1.778 6.76171 1.64985 7.32997C1.53086 7.86035 1.89177 8.33039 2.54558 8.48053C4.11475 8.84113 5.68391 9.26767 7.27269 9.53988C11.2061 10.2134 15.1455 10.8438 19.0911 11.4313C20.7257 11.6726 22.3824 11.7386 24.1046 11.8901ZM52.0266 47.4731L46.7123 53.9176C48.3456 54.8493 50.4365 54.3456 51.752 52.6548C52.9001 51.1843 52.9994 48.8383 52.0266 47.4731ZM43.8054 9.81349L34.2806 10.3172C34.346 10.9444 34.4114 11.5127 34.4742 12.1497C34.7644 12.1497 34.9972 12.1595 35.2339 12.1497C37.5589 12.0388 39.8852 11.9532 42.2075 11.8031C43.8054 11.6979 43.8054 11.6572 43.8054 9.81349ZM53.8912 10.2919C54.8667 10.1109 55.8527 9.95099 56.8295 9.74052C58.7265 9.33268 60.6203 8.90707 62.5112 8.46369C63.1362 8.32338 63.4592 7.84772 63.3546 7.3412C63.2382 6.77153 62.7858 6.54282 62.1189 6.68594C59.712 7.2079 57.3029 7.72518 54.8916 8.23779C53.4362 8.54928 53.4362 8.54788 53.7827 10.1418C53.7853 10.1601 53.8062 10.1769 53.8886 10.2919H53.8912ZM55.0289 1.93079C55.3087 3.59348 56.9093 5.21828 58.1188 5.11305C57.8246 3.50789 56.4254 2.04163 55.0263 1.93079H55.0289ZM8.58556 3.28479C8.84709 4.94889 10.4332 6.57229 11.6663 6.47267C11.3185 4.8198 9.96381 3.39564 8.58556 3.28479ZM17.9914 13.8797C16.4523 14.1407 14.9655 15.7683 14.9459 17.1644C16.366 16.9581 17.7913 15.4442 17.9914 13.8797ZM21.2775 31.2994C20.5779 29.7868 19.4089 28.8874 17.9992 28.3304C17.8475 28.2701 17.5899 28.524 17.3807 28.6321C17.4997 28.8285 17.5756 29.1133 17.7442 29.2087C18.6426 29.7167 19.5749 30.1629 20.4733 30.6624C20.7662 30.8237 21.0107 31.0847 21.2775 31.2994ZM7.31453 31.0651C8.45741 30.4687 9.62513 29.843 10.8085 29.2536C11.0949 29.1133 11.3878 28.973 11.1838 28.6293C11.0792 28.4497 10.6817 28.2869 10.5091 28.3613C9.18053 28.9365 8.02589 29.7686 7.31453 31.0651Z"
                    fill="#FFFFFF"
                />
                </svg>
            </div>

            <div class="d-flex align-items-center m-3">
                <a href="/" class="btn btn-secondary p-2 ms-3 border-radius-50">
                    <lord-icon
                        src="https://cdn.lordicon.com/igpbsrza.json"
                        trigger="hover"
                        colors="primary:#109173"
                        state="hover-1"
                        style="width:36px;height:36px">
                    </lord-icon>  
                </a>

            <div class="d-flex align-items-center">
                <div class="bg-secondary p-2 ms-3 border-radius-50 me-2">  <!-- Bottone della Dashboard -->
                    <lord-icon
                        src="https://cdn.lordicon.com/dklbhvrt.json"
                        trigger="hover"
                        colors="primary:#109173"
                        style="width:36px;height:36px">
                </lord-icon> 
            </div>

                <p class="text-secondary pt-3"><strong>{{Auth::user()->name}}</strong></p>
            </div>
            </div>
       </header>
        <div class="d-flex flex-grow-1 overflow-hidden">
            <aside class="bg-primary user-aside">
                <div class="list-group">
                    <div>
                        <a href="{{route('user.dashboard')}}" class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('user')) ? 'bg-secondary' : 'bg-primary' }}" aria-current="true">
                            <lord-icon
                                src="https://cdn.lordicon.com/gqdnbnwt.json"
                                trigger="loop-on-hover"
                                style="width:50px;height:50px"
                                colors="{{(request()->is('user')) ? 'primary:#109173,secondary:#109173' : 'primary:#ffffff,secondary:#ffffff'}}">
                            </lord-icon>
                            <strong class="{{(request()->is('user')) ? 'text-primary' : 'text-secondary'}} aside-item">Dashboard</strong>
                        </a>
                    </div>

                    <div>
                        @if(Auth::user()->apartments->count() > 0)
                        <a href="{{route('user.apartment.index')}}" class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('user/apartment')) ? 'bg-secondary' : 'bg-primary' }}" aria-current="true">
                            <lord-icon
                                src="https://cdn.lordicon.com/gmzxduhd.json"
                                trigger="loop-on-hover"
                                style="width:50px;height:50px"
                                colors="{{(request()->is('user/apartment')) ? 'primary:#109173,secondary:#109173' : 'primary:#ffffff,secondary:#ffffff'}}">
                            </lord-icon>
                            <strong class="{{(request()->is('user/apartment')) ? 'text-primary' : 'text-secondary'}} aside-item">Appartamenti</strong>
                        </a>
                        @endif
                        <a href="{{route("user.apartment.create")}}" class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('user/apartment/create')) ? 'bg-secondary' : 'bg-primary' }}">
                            <lord-icon
                                src="https://cdn.lordicon.com/mecwbjnp.json"
                                trigger="loop-on-hover"
                                style="width:50px;height:50px"
                                colors="{{(request()->is('user/apartment/create')) ? 'primary:#109173,secondary:#109173' : 'primary:#ffffff,secondary:#ffffff'}}">
                            </lord-icon>
                            <strong class="{{(request()->is('user/apartment/create')) ? 'text-primary' : 'text-secondary'}} aside-item">Aggiungi appartamento</strong>
                        </a>
                    </div>

                    <div>
                        <a href="{{route('user.messages', Auth::user()->id)}}" class="list-group-item list-group-item-action d-flex align-items-center {{ (request()->is('user/' . Auth::user()->id .'/messages')) ? 'bg-secondary' : 'bg-primary' }}" aria-current="true">
                                <lord-icon
                                    src="https://cdn.lordicon.com/rhvddzym.json"
                                    trigger="hover"
                                    style="width:50px;height:50px"
                                    colors="primary:{{ (request()->is('user/' . Auth::user()->id .'/messages')) ? '#109173' : '#ffffff' }}, secondary:#000000"
                                >
                                </lord-icon>
                            <strong class="{{ (request()->is('user/' . Auth::user()->id .'/messages')) ? 'text-primary' : 'text-secondary' }} aside-item">Messaggi</strong>
                        </a>
                    </div>
                    <div class="logout">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                                <button type="submit" class="user-button w-100">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/lywgqtim.json"
                                        trigger="loop-on-hover"
                                        style="width:50px;height:50px"
                                        colors="primary:#ffffff,secondary:#ffffff"
                                    >
                                    </lord-icon>
                                    <strong class="text-white aside-item">Logout</strong>
                                </button>
                        </form>
                        
                    </div>
                </div>
            </aside>
            <main class="bg-secondary flex-grow-1 overflow-auto">
                @yield('content')
            </main>

        </div>
    </div>
</body>
</html>
