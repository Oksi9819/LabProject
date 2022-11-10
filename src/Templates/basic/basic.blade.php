<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
</head>
<body>
    <header>
      <div class="logo">
        <a href="{{BASEPATH}}"><img src="{{BASEPATH}}src/pics/basepic.jpg" alt="Logo"></a> 
        <a href="{{BASEPATH}}"><h2>LabProject</h2></a>
      </div>
      <nav class="menu header-menu"><!--Навигация {{$title}}:-->
        <ul class="menu header-menu">
          <li><a href="{{BASEPATH}}">Главная</a></li>
          <li><a href="{{BASEPATH}}catalog">Каталог</a>
            <ul class="submenu header-submenu">
              @foreach ($categories as $category)
                <li>
                  <a 
                    href="{{BASEPATH}}catalog/category/{{$category['name_eng']}}"
                  >Категория {{$category['category_name']}}</a>
                </li>
              @endforeach
              <!--<li><a href="'.BASEPATH.'catalog/search">Поисковая строка в каталоге</a></li>-->
            </ul>
          </li>
          <li><a href="{{BASEPATH}}contacts">Контакты</a></li>
          <li><a href="{{BASEPATH}}delivery">Доставка</a></li>
          @isset($SESSION)
            @if ($SESSION['role'] === "Admin")
              <li class="penult"><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, Администатор {{$SESSION['name']}}</a>
                <ul class="submenu header-submenu">
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/info"
                    >Информация об администаторе id{{$SESSION['id']}}</a>
                  </li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews">Отзывы</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders">Заказы</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/users">Все пользователи</a></li>
                  <li><a href="{{BASEPATH}}profile/{{$SESSION['id']}}/admins">Все администраторы</a></li>
                  <!--<li><a href="{{BASEPATH}}cart/2256665">Корзина пользователя 2256665</a></li>-->
                </ul>
              </li>
            @else
              <li class="penult"><a href="{{BASEPATH}}profile/{{$SESSION['id']}}">Привет, {{$SESSION['name']}}</a>
                <ul class="submenu header-submenu">
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/info"
                    >Информация о пользователе id{{$SESSION['id']}}</a>
                  </li>
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews"
                    >Все отзывы пользователя id{{$SESSION['id']}}</a>
                  </li>
                  <li>
                    <a 
                      href="{{BASEPATH}}profile/{{$SESSION['id']}}/orders"
                    >Все заказы пользователя id{{$SESSION['id']}}</a>
                  </li>
                </ul>
              </li>            
            @endif
              <li><a href="{{BASEPATH}}exit/profile/{{$SESSION['id']}}">Выйти</a></li>
          @endisset
          @empty($SESSION)
              <li class="penult"><a href="{{BASEPATH}}registration-form">Регистрация</a></li>
              <li class="penult one"><a href="{{BASEPATH}}authorization-form">Авторизация</a></li>
          @endempty
              <li><a href="{{BASEPATH}}cart"><img 
                  id="open_cart"
                  class="cart"
                  src="{{BASEPATH}}src/pics/cart.png" 
                  alt="Cart"
                ></a></li><br><br>
      </nav>
    </header>
    <main>
        <article>
            @yield('article')
        </article>
    </main>
    <footer>
        <p>This is ProjectShop</p>
        <p>Constructed by Oksi</p>
        <p>Belarus, {{$year}}</p>
    </footer>
    <script src="{{BASEPATH}}front_src/dist/bundle.js"></script>
</body>  
</html>