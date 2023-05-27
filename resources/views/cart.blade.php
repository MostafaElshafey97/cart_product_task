<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Cart</h1>
        <form method="POST" action="{{ route('calculate') }}">
            @csrf
            <div class="form-group">
                <label for="country">Country:</label>
                <select class="form-control" name="country" id="country">
                    <option value="US">US</option>
                    <option value="UK">UK</option>
                    <option value="CN">CN</option>
                </select>
            </div>
            <div class="form-group">
                <label>Products:</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="T-shirt" id="product1">
                    <label class="form-check-label" for="product1">
                        T-shirt ($30.99)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="Blouse" id="product2">
                    <label class="form-check-label" for="product2">
                        Blouse ($10.99)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="Pants" id="product3">
                    <label class="form-check-label" for="product3">
                        Pants ($64.99)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="Sweatpants" id="product4">
                    <label class="form-check-label" for="product4">
                        Sweatpants ($84.99)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="Jacket" id="product5">
                    <label class="form-check-label" for="product5">
                        Jacket ($199.99)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="Shoes" id="product6">
                    <label class="form-check-label" for="product6">
                        Shoes ($79.99)
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>
</body>
</html>