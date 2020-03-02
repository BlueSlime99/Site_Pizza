
<p class="error"><?= $error??""?></p>

<div class="center">
    <h1>Add Pizza</h1>
    <form method="post">              
        <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Name</label></td>
                         <td><input type="text" name="name" class="form-control" id="inputNom" placeholder="Name" required value="<?= $data['name']??""?>">
                         </td>
                    </tr>
                    <tr>
                       <td> <label for="inputPrenom" class="control-label">Price</label></td>
                          <td>  <input type="text" name="price" class="form-control" id="inputPrenom" placeholder="Price" required aria-required="true" value="<?= $data['price']??""?>"></td>
                    </tr>
        </table>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add it</button>
                    </div>
    </form>
    </div>

<?php

include("footer.php");