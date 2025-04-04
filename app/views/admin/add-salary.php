<?php if ($section == 'add-salary'): ?>
    <div style="width:60%;margin:2rem auto; background:#fff;padding:1rem;min-height:300px"><table border="0" style="width:100%;border-collapse:collapse">

        <h1>Time Per Hour is <a href=""><?=$result['hours_works']?></a> €</h1>
        <form action="" method="post">
            <input type="number" name="hours_works" min="1" style="max-width: 100px;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;">
            <button type="submit" name="btn-submit" style="max-width: 70px;padding:0.5rem;width:8rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;cursor:pointer">Submit</button>
        </form>
    </div>
<?php endif; ?>