<!DOCTYPE html>
<html>

<head>
    <title>stk push</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="text-center text-light bg-primary">
        <?php if(isset($_GET['error'])){ ?>
        <p class="error">
            <?php echo $_GET['error']; ?>
        </p>
        <?php } ?>
    </div>
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <form action="action.php" method="POST">
                    <input type="text" name="amount" id="amount" placeholder="amount" required />
                    <input type="text" name="phone" id="phone" placeholder="phone" required />
                    <input type="submit" class="btn btn-outline-warning" />
                </form>
            </div>
            <div class=" col">
                <p>Make payments through stk push</p>
            </div>
            <div class="col">
                <p>Follow this method</p>
            </div>
        </div>
    </div>
</body>

</html>