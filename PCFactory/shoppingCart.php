<?php

session_start();
$product_ids = array();
//session_destroy();
$connect = mysqli_connect('localhost', 'root', 'mypass123', 'cart');

//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST,'add_to_cart'))
{
    //if shopping cart $_SESSION variable already exists, add items to the existing cart array
    if(isset($_SESSION['shopping_cart']))
    {
        //keep track how many products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);  //count() starts from 1, array keys start from 0

        //create sequential for matching array keys to product id's
        $product_ids = array_column($_SESSION['shopping_cart'],'id');

        //if the product being added to the cart does NOT exist in the array
        if(!in_array(filter_input(INPUT_GET,'id'), $product_ids))
        {
            //fill the $_SESSION shopping cart array with GET id variable and POST form values
            $_SESSION['shopping_cart'][$count] = array //add next array key based on session count
            (
                'id'        =>  filter_input(INPUT_GET,'id'),
                'name'      =>  filter_input(INPUT_POST,'name'),
                'price'     =>  filter_input(INPUT_POST,'price'),
                'quantity'  =>  filter_input(INPUT_POST,'quantity')
            );
        }
        else  //product already exists, increase quantity
        {
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++)
            {
                if ($product_ids[$i] == filter_input(INPUT_GET,'id'))
                {
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');
                }
            }
        }
    }
    else  //if shopping cart doesn't exist, create first product with array key 0
    {
        //create array using submitted form data, starting from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id'        =>  filter_input(INPUT_GET,'id'),
            'name'      =>  filter_input(INPUT_POST,'name'),
            'price'     =>  filter_input(INPUT_POST,'price'),
            'quantity'  =>  filter_input(INPUT_POST,'quantity')
        );
    }
}

//removing products from the shopping cart session
if(filter_input(INPUT_GET,'action'))
{
    if(filter_input(INPUT_GET,'action') == 'delete')
    {
        //loop through all products in the shopping cart until it matches GET id variable
        foreach($_SESSION['shopping_cart'] as $key => $product)
        {
            if($product['id'] == filter_input(INPUT_GET,'id'))
            {
                //remove product from the shopping cart when it matches with the GET id
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
        //reset session array keys so they match with $product_ids numeric array
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
}

//pre_r($product_ids);
//pre_r($_SESSION['shopping_cart']);

function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PCFactory Home</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="styles/customStyles.css" rel="stylesheet">
    <!--    <link href="styles/cartStyle.css" rel="stylesheet">-->
    <link rel="stylesheet" href="shopCart.css" />
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">PCFactory</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="index.php">Home</a>
        <a class="p-2 text-dark" href="aboutUs.php">About Us</a>
        <a class="p-2 text-dark" href="contact.php">Contact</a>
    </nav>
    <a class="btn btn-outline-primary" href="shoppingCart.php">Shopping Cart</a>
</div>


<div class="container">
    <?php
    $query = 'SELECT * FROM products ORDER BY id ASC';
    $result = mysqli_query($connect, $query);
    if ($result): //checks to make sure the products table is not empty
        if(mysqli_num_rows($result) > 0):
            while($product = mysqli_fetch_array($result)):
                ?>
                <div class="col-sm-4 col-md-3">
                    <form method="post" action="index.php?action=add&id=<?php echo $product['id']; ?>">
                        <div class="products">
                            <img src="<?php echo $product['image']; ?>" class="img-responsive" /><br />
                            <h4 class="text-info"><?php echo $product['name']; ?></h4>
                            <h4>$ <?php echo $product['price']; ?></h4>
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            &nbsp;
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success"
                                   value="Add to Cart" />
                        </div>
                    </form>
                </div>
                <?php
            endwhile;
        endif;
    endif;
    ?>
    <div style="clear:both"></div>
    <br />
    <div class="table-responsive">
        <table class="table">
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>
            <tr>
                <th width="40%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION['shopping_cart'])):

                $total = 0;

                foreach($_SESSION['shopping_cart'] as $key => $product):
                    ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td>$ <?php echo $product['price']; ?></td>
                        <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                        <td>
                            <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                                <div class="btn-danger">Remove</div>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $total = $total + ($product['quantity'] * $product['price']);
                endforeach;
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <!-- Show checkout button only if the shopping cart is not empty -->
                    <td colspan="5">
                        <?php
                        if (isset($_SESSION['shopping_cart'])):
                            if (count($_SESSION['shopping_cart']) > 0):
                                ?>
                                <a href="#" class="button">Checkout</a>
                            <?php endif; endif; ?>
                    </td>
                </tr>
                <?php
            endif;
            ?>
        </table>
    </div>
</div>

<div class="container">
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="../../assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
                <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Cool stuff</a></li>
                    <li><a class="text-muted" href="#">Random feature</a></li>
                    <li><a class="text-muted" href="#">Team feature</a></li>
                    <li><a class="text-muted" href="#">Stuff for developers</a></li>
                    <li><a class="text-muted" href="#">Another one</a></li>
                    <li><a class="text-muted" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                    <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                    <li><a class="text-muted" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
</body>

</html>