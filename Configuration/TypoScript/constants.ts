plugin.tx_carouselgallery {
	view {
		# cat=plugin.tx_carouselgallery/file; type=string; label=Path to template root (FE)
		templateRootPath = EXT:carousel_gallery/Resources/Private/Templates/
		# cat=plugin.tx_carouselgallery/file; type=string; label=Path to template partials (FE)
		partialRootPath = EXT:carousel_gallery/Resources/Private/Partials/
		# cat=plugin.tx_carouselgallery/file; type=string; label=Path to template layouts (FE)
		layoutRootPath = EXT:carousel_gallery/Resources/Private/Layouts/
	}
	persistence {
		# cat=plugin.tx_carouselgallery//a; type=int+; label=Default storage PID
		storagePid =
	}
}