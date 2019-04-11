<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="/logout"><i class="material-icons">input</i>{{ __('Logout') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">Menu</li>
                <li @if ($menu == 'admin')class="active" @endif>
                    <a href="/admin">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>


                <li @if ($menu == 'user')class="active" @endif>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">accessible</i>
                        <span>Thành viên</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (@$menu_item == 'user-manager')class="active"  @endif>
                            <a href="/admin/user-manager/">Quản lý thành viên</a>
                        </li>
                        <li @if (@$menu_item == 'user-create')class="active"  @endif>
                            <a href="/admin/user-create/">Tạo thành viên</a>
                        </li>
                    </ul>
                </li>
                <!-- <li @if ($menu == 'paypal')class="active" @endif>
                    <a href="/admin/paypal-manager/">
                        <i class="material-icons">payment</i>
                        <span>Quản lý nạp tiền</span>
                    </a>

                </li>-->
                <li @if ($menu == 'history')class="active" @endif>
                    <a href="/admin/history-manager/">
                        <i class="material-icons">library_music</i>
                        <span>Quản lý mua bài</span>
                    </a>

                </li>
                <li @if ($menu == 'category')class="active" @endif>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">list</i>
                        <span>Danh Mục</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (@$menu_item == 'category-manager')class="active"  @endif>
                            <a href="/admin/category-manager/">Quản lý danh mục</a>
                        </li>
                        <li @if (@$menu_item == 'category-create')class="active"  @endif>
                            <a href="/admin/category-create/">Tạo danh mục</a>
                        </li>
                    </ul>
                </li>

                <li @if ($menu == 'product')class="active" @endif>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_music</i>
                        <span>Bài Thiền</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (@$menu_item == 'product-manager')class="active"  @endif>
                            <a href="/admin/product-manager/">Quản lý bài thiền</a>
                        </li>
                        <li @if (@$menu_item == 'product-create')class="active"  @endif>
                            <a href="/admin/product-create/">Tạo bài thiền</a>
                        </li>
                    </ul>
                </li>
                <li @if ($menu == 'background')class="active" @endif>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">image</i>
                        <span>Hình nền</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (@$menu_item == 'background-manager')class="active"  @endif>
                            <a href="/admin/background-manager/">Quản lý hình nền</a>
                        </li>
                        <li @if (@$menu_item == 'background-create')class="active"  @endif>
                            <a href="/admin/background-create/">Tạo hình nền</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">Design By Luu Nguyen - luunguyenthanh91@gmail.com</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- #END# Right Sidebar -->
</section>
