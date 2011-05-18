<div id="myGallery" class="<?= $classes; ?>" style="<?= $style; ?>">
  <?php foreach( $this->listOfItems as $item ): ?>
  <div class="imageElement">  
    <h3><?= $item->getTitle(); ?></h3>
    <p><?= $item->getDescription(); ?></p>
    <a href="#" title="<?= $this->tooltip; ?>" class="open"></a>
    <img src="<?= $item->getOriginal(); ?>" class="full" />
    <img src="<?= $item->getThumbnail(); ?>" class="thumbnail" />
  </div>    
  <?php endforeach; ?>
</div>
