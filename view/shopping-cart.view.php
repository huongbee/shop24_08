<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          <?php if($data['cart']==null):?>
          <div class="page-content page-order">
            <div class="page-title" style="text-align:center">
              <h2>Giỏ hàng rỗng</h2>
              <div class="cart_navigation"> 
                <a class="continue-btn" href="./">
                  <i class="fa fa-arrow-left"> </i>&nbsp; Về trang chủ
                </a>
              </div>
            </div>
          </div>
          <?php else:?>
          <div class="page-content page-order">
            <div class="page-title">
              <h2>Giỏ hàng của bạn</h2>
            </div>
            
            
            <div class="order-detail-content">
              <div class="table-responsive">
                <table class="table table-bordered cart_summary">
                  <thead>
                    <tr>
                      <th class="cart_product">Hình ảnh</th>
                      <th>Tên Sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                      <th  class="action"><i class="fa fa-trash-o"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['cart']->items as $id => $item):?>
                    <tr id="cart-remove-<?=$id?>">
                      <td class="cart_product"><a href="#">
                        <img src="public/source/images/products-images/<?=$item['item']->image?>" alt="<?=$item['item']->name?>">
                      </a></td>
                      <td class="cart_description"><p class="product-name">
                        <a href="#"><?=$item['item']->name?></a></p>
                      </td>
                      <td class="price">
                        <del style="color:dimgrey">
                        <?=number_format($item['item']->price)?>
                        </del>
                        <br>
                        <span>
                          <?=number_format($item['item']->promotion_price)?>
                        </span>
                      </td>
                      <td class="qty">
                        <input class="form-control input-sm txtQty" type="text" 
                          value="<?=$item['qty']?>" data-id="<?=$id?>">
                      </td>
                      <td class="price price-change-<?=$id?>">
                        <del style="color:dimgrey">
                          <?=number_format($item['price'])?>
                        </del>
                        <br>
                        <span>
                          <?=number_format($item['discountPrice'])?>
                        </span>
                      </td>
                      <td class="action">
                        <a data-id="<?=$id?>"><i class="icon-close"></i></a>
                      </td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Tổng tiền</td>
                      <td colspan="2" id="totalPrice"><?=number_format($data['cart']->totalPrice)?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><strong>Thanh toán</strong></td>
                      <td colspan="2"><strong id="promtPrice"><?=number_format($data['cart']->promtPrice)?></strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="cart_navigation"> <a class="continue-btn" href="./"><i class="fa fa-arrow-left"> </i>&nbsp; Tiếp tục mua sắm</a> <a class="checkout-btn" href="checkout.php"><i class="fa fa-check"></i>Thanh toán</a> </div>
            </div>
          </div>
          <?php endif?>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="public/source/js/jquery.min.js"></script>
  <script>
  $(document).ready(function(){

    var timeout = null;

    $('.txtQty').on('keyup',function () {
        var qty = $(this).val()
        if(isNaN(qty)){
          alert('Vui lòng nhập số')
          $(this).val(1)
          $(this).focus()
          return false;
        }
        if( parseInt(qty)===0 ) {
          alert('Vui lòng nhập số lượng > 0')
          $(this).val(1)
          $(this).focus()
          return false;
        }
        if( qty=='') {
          $(this).focus()
          return false;
        }
        var idSP = $(this).attr('data-id')

        clearTimeout(timeout);
        timeout = setTimeout(function () {
            $.ajax({
              url:'cart.php',
              data:{
                idSP:idSP,
                qty:qty,
                action:'update'
              },
              type:'POST',
              dataType:"json",
              success:function(res){
                $('.cart-total').html(res.data.cart_header)
                $('#totalPrice').html(res.data.totalPrice)
                $('#promtPrice').html(res.data.promtPrice)
                $('.price-change-'+idSP+' del').html(res.data.price)
                $('.price-change-'+idSP+' span').html(res.data.discountPrice)
              },
              error:function(){
                console.log('err')
              }
            })
            
        },1000);
    });


    $('.action a').click(function(){
      var idSP = $(this).attr('data-id')
      $.ajax({
        url:'cart.php',
        data:{
          idSP:idSP,
          action:'delete'
        },
        type:'POST',
        dataType:"json",
        success:function(res){
          $('#cart-remove-'+idSP).hide(500)
          $('.cart-total').html(res.data.cart_header)
          $('#totalPrice').html(res.data.totalPrice)
          $('#promtPrice').html(res.data.promtPrice)
        },
        error:function(){
          console.log('err')
        }
      })
    })
    
  })
  </script>
