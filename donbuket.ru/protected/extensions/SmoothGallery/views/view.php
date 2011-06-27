<div class="gallery_content">
<!--  <h1>Galeraia classic theme</h1>
  <p> demo a basic gallery example.</p> -->
  <div id="gallery<?= $this->getId()?>">
    <?php foreach ($this->listOfImages as $item): ?>
    <a href='<?= $item->getOriginal();?>' >
    <img title="<?= $item->getTitle(); ?>"
         alt="<?= $item->getDescription(); ?>"
         src="<?= $item->getThumbnail(); ?>" />
      </a>
    <?php endforeach; ?>
  </div>
</div>
