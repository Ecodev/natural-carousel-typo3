#################################
# plugin.tx_carouselgallery
#################################

plugin.tx_carouselgallery {
	view {
		templateRootPath = {$plugin.tx_carouselgallery.view.templateRootPath}
		partialRootPath = {$plugin.tx_carouselgallery.view.partialRootPath}
		layoutRootPath = {$plugin.tx_carouselgallery.view.layoutRootPath}
	}
	persistence {
		storagePid = {$plugin.tx_carouselgallery.persistence.storagePid}
	}

	settings {

		asset {

			SwiperCss {
				path = EXT:carousel_gallery/Resources/Public/StyleSheets/swiper.min.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}
			CarouselGalleryCss {
				path = EXT:carousel_gallery/Resources/Public/StyleSheets/CarouselGallery.css
				type = css

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainCss
			}

			SwiperJs {
				path = EXT:carousel_gallery/Resources/Public/JavaScript/swiper.min.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
			CarouselGalleryJs {
				path = EXT:carousel_gallery/Resources/Public/JavaScript/CarouselGallery.js
				type = js

				# Optional key if loading assets through EXT:vhs.
				dependencies = mainJs
			}
		}

		loadAssetWithVhsIfAvailable = 1
	}
}
