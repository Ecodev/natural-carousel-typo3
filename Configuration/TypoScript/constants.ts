plugin.tx_agilecarousel {
	view {
		# cat=plugin.tx_agilecarousel/file; type=string; label=Path to template root (FE)
		templateRootPath = EXT:agile_carousel/Resources/Private/Templates/
		# cat=plugin.tx_agilecarousel/file; type=string; label=Path to template partials (FE)
		partialRootPath = EXT:agile_carousel/Resources/Private/Partials/
		# cat=plugin.tx_agilecarousel/file; type=string; label=Path to template layouts (FE)
		layoutRootPath = EXT:agile_carousel/Resources/Private/Layouts/
	}
	persistence {
		# cat=plugin.tx_agilecarousel//a; type=int+; label=Default storage PID
		storagePid =
	}
}