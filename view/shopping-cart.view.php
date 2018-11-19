<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          
          <div class="page-content page-order"><div class="page-title">
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
                    <?php foreach($data['cart']->items as $item):?>
                    <tr>
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
                        <input class="form-control input-sm" type="text" 
                          value="<?=$item['qty']?>">
                      </td>
                      <td class="price">
                      <del style="color:dimgrey">
                        <?=number_format($item['price'])?>
                        </del>
                        <br>
                        <span>
                          <?=number_format($item['discountPrice'])?>
                        </span>
                      </td>
                      <td class="action"><a href="#"><i class="icon-close"></i></a></td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Total products (tax incl.)</td>
                      <td colspan="2">$237.88 </td>
                    </tr>
                    <tr>
                      <td colspan="3"><strong>Total</strong></td>
                      <td colspan="2"><strong>$237.88 </strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="cart_navigation"> <a class="continue-btn" href="#"><i class="fa fa-arrow-left"> </i>&nbsp; Continue shopping</a> <a class="checkout-btn" href="#"><i class="fa fa-check"></i> Proceed to checkout</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>