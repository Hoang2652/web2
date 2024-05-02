<main class="main" id="abc">
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                <div class="home__container container grid">
                    <?php 
                        $sql0="select sanpham.*,sanphamdecu.idsanphamdecu from sanpham,sanphamdecu where sanpham.idsanpham=sanphamdecu.idsanpham AND trangthai='1' AND idsanphamdecu='1' LIMIT 0,1";
                        $toppageproduct = mysqli_query($link,$sql0);
                        while($rows0=mysqli_fetch_array($toppageproduct)){
                    ?>
                    <div class="home__img-bg">
                        <img src="img/uploads/<?php echo $rows0['hinhanh'] ?>" alt="" class="home__img">
                    </div>
    
                    <div class="home__data">
                        <h1 class="home__title"><br> <?php echo $rows0['tensanpham'] ?></h1>
                        <p class="home__description">
                        <?php echo $rows0['mota'] ?>
                        </p>
                        <span class="home__price"><?php echo number_format($rows0['gia'],0,",",".");?> VNĐ</span>

                        <div class="home__btns">
                            <a href="index.php?content=chitietsp&idsanpham=<?php echo $rows0['idsanpham'] ?>" class="button button--gray button--small">
                                Chi tiết
                            </a>
                            <form action="index.php?content=cart&action=add&idsanpham=<?php echo $rows0['idsanpham'] ?>" class="button" method="post">
                                <?php 
                                if($rows0['soluong'] <=0){
                                    ?><a href='index.php?content=hethang' class="button home__button">Thêm giỏ hàng</a> <?php
                                } else { ?>
                                    <button class="home__button" type="submit" name="chovaogio">Thêm giỏ hàng</button>
                                <?php } ?>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <!--==================== FEATURED ====================-->
            <section class="featured section container" id="featured">
                <h2 class="section__title" style="color: hsl(206, 93%, 55%);">
                    MẶT HÀNG BÁN CHẠY
                </h2>

                <div class="featured__container grid">
                <?php 
                $sql1="select * from sanpham where trangthai='1' order by daban DESC LIMIT 0,6";
                $bestsellproduct = mysqli_query($link,$sql1);
                while($rows=mysqli_fetch_array($bestsellproduct)){
                    productCard($rows['idsanpham'],$rows['hinhanh'],$rows['tensanpham'],$rows['gia']);
                } 
                ?>
                </div>
            </section>

            <!--==================== STORY ====================-->
            <section class="story section container">
                <div class="story__container grid">
                    <div class="story__data">
                        <?php 
                        $sqlspecial="select sanpham.*,sanphamdecu.idsanphamdecu from sanpham,sanphamdecu where sanpham.idsanpham=sanphamdecu.idsanpham AND trangthai='1' AND idsanphamdecu='2' LIMIT 0,1";
                        $midpageproduct = mysqli_query($link,$sqlspecial);
                        while($rows5=mysqli_fetch_array($midpageproduct)){
                        ?>
                        <h2 class="section__title story__section-title">
                            Sản phẩm đặc biệt
                        </h2>
    
                        <h1 class="story__title">
                            <?php echo $rows5['tensanpham'] ?>
                        </h1>
    
                        <p class="story__description">
                            <?php echo $rows5['mota'] ?>
                        </p>
    
                        <a href="index.php?content=chitietsp&idsanpham=<?php echo $rows5['idsanpham'] ?>" class="button button--small">Xem chi tiết</a>
                    </div>

                    <div class="story__images">
                        <img src="img/uploads/<?php echo $rows5['hinhanh'] ?>" alt="" class="story__img">
                        <div class="story__square"></div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <!--==================== PRODUCTS ====================-->
            <section class="products section container" id="products">
                <h2 class="section__title" style="color: hsl(206, 93%, 55%);">
                    SẢN PHẨM MỚI NHẤT
                </h2>
                <div class="products__container grid">
                <?php 
                $sql2="select * from sanpham where trangthai='1' order by ngaycapnhat LIMIT 0,6";
                $newproduct = mysqli_query($link,$sql2);
                while($rows=mysqli_fetch_array($newproduct)){
                ?>
                    <article class="products__card">
                        <a href="index.php?content=chitietsp&idsanpham=<?php echo $rows['idsanpham'] ?>">
                            <img src="img/uploads/<?php echo $rows['hinhanh'];?>" alt="" class="products__img">

                            <h3 class="products__title"><?php echo $rows['tensanpham'];?></h3>
                            <span class="products__price"><?php echo number_format($rows['gia'],0,",",".");?> VNĐ</span>
                        </a>
                    </article>
                <?php } ?>
                </div>
            </section>

            <!--==================== TESTIMONIAL ====================-->
            <section class="testimonial section container">
                <div class="testimonial__container grid">
                    <div class="testimonial-swiper">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php 
                                $sql3="select * from tintuc order by ngaydangtin DESC LIMIT 0,3";
                                $news = mysqli_query($link,$sql3);
                                while($rows=mysqli_fetch_array($news)){
                                ?>
                                <a href="index.php?content=chitiettintuc&idtintuc=<?php echo $rows['idtintuc'] ?>">
                                    <div class="swiper-slide">
                                        <div class="testimonial__quote">
                                            <i class='bx bxs-quote-alt-left' ></i><h5>   <?php echo $rows['tieude'] ?></h5>
                                        </div>
                                        <p class="testimonial__description"> <?php echo $rows['noidungngan'] ?> </p>
                                        <h3 class="testimonial__date">Ngày đăng tin: <?php echo $rows['ngaydangtin'] ?></h3>
                
                                        <!-- <div class="testimonial__perfil">
                                            <img src="img/assets/testimonial1.jpg" alt="" class="testimonial__perfil-img">
                
                                            <div class="testimonial__perfil-data">
                                                <span class="testimonial__perfil-name">Lee Doe</span>
                                                <span class="testimonial__perfil-detail"> Giám đốc </span>
                                            </div>
                                        </div> -->
                                    </div>
                                </a>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="swiper-button-wrapper"> 
                            <div class="swiper-button-prev">
                                <i class='bx bx-left-arrow-alt' ></i>
                            </div>
                            <div class="swiper-button-next">
                                <i class='bx bx-right-arrow-alt' ></i>
                            </div>
                        </div> 
                    </div>
                    <div class="testimonial__images">
                        <div class="testimonial__square"></div>
                        <img src="img/assets/testimonial.png" alt="" class="testimonial__img">
                    </div>
                </div>
            </section>

            <!--==================== NEW ====================-->
    <section class="new section container" id="new">
        <h2 class="section__title" style="color: hsl(206, 93%, 55%);">
            SẢN PHẨM ĐỀ CỬ
        </h2>
        <div class="new__container">
            <div class="swiper new-swiper">
                <div class="swiper-wrapper-1">
                    <?php 
                    $sql4="select sanpham.*,sanphamdecu.idsanphamdecu from sanpham,sanphamdecu where sanpham.idsanpham=sanphamdecu.idsanpham AND trangthai='1' AND idsanphamdecu='3' LIMIT 0,8";
                    $recommendedproduct = mysqli_query($link,$sql4);
                    while($rows=mysqli_fetch_array($recommendedproduct)){
                        productCardRecommended($rows['idsanpham'],$rows['hinhanh'],$rows['tensanpham'],$rows['gia']);
                    } ?>
                </div>
                <div class="new-button-wrapper"> 
                    <div class="new-button-prev">
                        <i class='bx bx-chevron-left'></i>
                    </div>
                    <div class="new-button-next">
                        <i class='bx bx-chevron-right' ></i>
                    </div>
                </div> 
            </div>
        </div>
    </section>

            <!--==================== NEWSLETTER ====================-->
            <section class="newsletter section container">
                <div class="newsletter__bg grid">
                    <div>
                        <h2 class="newsletter__title">Liên hệ với chúng tôi</h2>
                        <p class="newsletter__description">
                            Đừng bỏ lỡ các đợt giảm giá của bạn. Đăng kí bản tin qua 
                            email của chúng tôi để nhận được thêm nhiều ưu đãi, chiết khấu 
                            giảm giá, quà tặng tốt nhất và nhiều hơn nữa
                        </p>
                    </div>

                    <form action="" class="newsletter__subscribe">
                        <input type="email" placeholder="Nhập email của bạn" class="newsletter__input">
                        <button class="button">
                            Đặt mua
                        </button>
                    </form>
                </div>
            </section>
        </main>