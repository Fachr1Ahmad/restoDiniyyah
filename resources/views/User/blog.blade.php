@extends('User.itestimoni')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Blog</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="/Home">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white"><a class="text-white" href="/blog">Blog</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

      <!-- ======= Blog Single Section ======= -->
      <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

        <div class="col-lg-8 entries">

            <article class="entry entry-single">

                <div class="entry-img">
                    <img src="assets/img/blog.jpg" alt="" class="img-fluid">
                </div>

                <div class="entry-meta">
                    <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">Ryan Ramadhan</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2020-01-01">Des 10, 2022</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#">All Comments</a></li>
                    </ul>
                </div>

                <div class="entry-content">
                    <p>
                    DigiCoffee shop adalah sebuah aplikasi yang menyediakan makanan dan minuman, namun utamanya menjual kopi. 
                    Umumnya, yang disebut dengan coffee shop, adalah kedai minum kopi yang tempatnya didesain menarik dan menyediakan banyak menu kopi.
                    </p>

                    <p>
                    Sejumlah tempat juga menyediakan menu kopi dengan berbagai macam cara menyeduhnya. Dari tubruk, french press, aeropress, vietnam drip, v60, chemex dan lain-lain.
                    </p>

                    <blockquote>
                    <p>
                    Buruan kasih tau kabar baik ini ke semua temen, sodara, dan keluargamu karena DigiCoffee memiliki coffee dan menu lainnya yang nikmat dan best!
                    </p>
                    </blockquote>

                    <h3>Pesan Coffee menjadi lebih mudah</h3>
                    <p>
                    Dengan adanya DigiCoffee anda dapat memesan coffee dengan mudah dan terdapat fitur fitur yang nyaman dan mudah digunakan 
                    </p>
                    <img src="assets/img/blog2.jpg" class="img-fluid" alt="">

                    <h3>Tempat Coffe yang paling enak dan nyaman</h3>
                    <p>
                        Kedai kopi berseliweran di kota-kota seluruh Indonesia. Salah satu nya adalah paling enak di DigiCoffee.
                    </p>
                    

                </div>

                <div class="entry-footer">
                    <i class="bi bi-tags"></i>
                      <ul class="tags">
                      @foreach($kategori as $row)
                        <li><a href="#">{{ $row->namaKategori }}</a></li>
                      @endforeach
                      </ul>
                    </ul>
                </div>
            </article><!-- End blog entry -->

            <div class="blog-comments">
                <h4 class="comments-count">All Testimoni</h4>
                <div id="comment-2" class="comment">
                  @foreach($testimoni as $row)
                  <div class="d-flex">
                    <div class="comment-img">
                      @empty($row->users->foto)
                        <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" style="border-radius: 5px;">
                      @else
                        <img src="{{ url('assets/img/user/'.$row->users->foto) }}" alt="Profile" style="border-radius: 5px;">
                      @endempty
                    </div>
                    <div>
                        <h5><a href="">{{ $row->users->name }}</a> 
                        
                        </h5>
                        <time datetime="2020-01-01">{{ $row->date }}</time>
                        <p>
                        {{ $row->pesan }}
                        </p>
                    </div>
                  </div>
                  @endforeach
                </div><!-- End comment #2-->

            </div>
        </div>

        <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
              @foreach($kategori as $row)
                <ul>
                  <li>{{ $row->namaKategori }}</li>
                </ul>
              @endforeach
              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">List Menu</h3>
              @foreach($menu as $row)
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  @empty($row->foto)
                    <img src="{{ url('assets/img/menu/nophoto.png') }}" alt="menu" >
                  @else
                    <img src="{{ url('assets/img/menu/'.$row->foto) }}" alt="menu" >
                  @endempty
                  <h4 style="font-size: 16px;"><a href="#">{{$row->namaMenu}}</a></h4>
                  <h4 style="font-size: 12px;"><a href="#">{{$row->kategori->namaKategori}}</a></h4>
                  <time datetime="2020-01-01">{{$row->harga}}</time>
                </div>
              </div><!-- End sidebar recent posts-->
              @endforeach

              <h3 class="sidebar-title">Tags Kategori DigiCoffee</h3>
              <div class="sidebar-item tags">
                <ul>
              @foreach($kategori as $row)
                  <li><a href="#">{{ $row->namaKategori }}</a></li>
              @endforeach
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

@endsection