<?php
class contents{
    public function main_content(){
?>
    <div class="row align-items-md-stretch">
        <div class="col-md-9">
          <div class="h-100 p-5 text-bg-dark rounded-3">
            <h2>Main Content</h2>
            <p>Habiba</p>
          </div>
        </div>


<?php
    }
    public function about_content(){
?>
<div class="row">
<div class="content">
    <H1>About Content</H1>
<p>fatma</p>
    </div>
<?php
    }

    public function side_bar(){
        ?>
        <div class="col-md-3">
          <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Add borders</h2>
            <p>Fatma</p>
            <button class="btn btn-outline-secondary" type="button">Example button</button>
          </div>
        </div>
        
      </div>

        <?php
    }
}