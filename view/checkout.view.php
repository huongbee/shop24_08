<!-- Main Container -->
<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-12 col-xs-12">
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Thanh toán</h2>
        </div>
            <div class="box-border">
                <form action="" method="POST">
                    <ul>
                        <li class="row">
                            <div class="col-sm-6">
                                <label for="first_name" class="required">Họ tên</label>
                                <input type="text" class="input form-control" name="fullname">
                            </div><!--/ [col] -->
                            <div class="col-sm-6">
                                <label class="required">Giới tính</label>
                                <br>
                                <label>
                                    <input type="radio" class="input" name="gender" value="Male"> Nam
                                </label>
                                <label style="margin-left:20px">
                                    <input type="radio" class="input" name="gender" value="Female"> Nữ
                                </label>
                                <label style="margin-left:20px">
                                    <input type="radio" class="input" name="gender" value="Other"> Khác
                                </label>
                            </div><!--/ [col] -->
                        </li><!--/ .row -->
                        <li class="row">
                            <div class="col-sm-6">
                                <label for="email_address" class="required">Email Address</label>
                                <input type="text" class="input form-control" name="email" id="email_address">
                            </div><!--/ [col] -->
                            <div class="col-sm-6">
                                <label for="telephone" class="required">Điện thoại</label>
                                <input class="input form-control" type="text" name="phone" id="telephone">
                            </div><!--/ [col] -->
                        </li>
                        <li class="row"> 
                            <div class="col-sm-12">
                                <label for="address" class="required">Địa chỉ</label>
                                <input type="text" class="input form-control" name="address" id="address">
                            </div><!--/ [col] -->
                        </li><!-- / .row -->
                        <li class="row">

                            <div class="col-sm-12">
                                <label for="address" class="required">Ghi chú</label>
                                <textarea name="note" class="form-control" rows="5"></textarea>
                            </div><!--/ [col] -->
                        </li>
                        <li>
                            <button class="button" type="submit"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Đặt hàng</span></button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
      </div>
      
    </div>
  </div>
  </section>
  <!-- Main Container End -->