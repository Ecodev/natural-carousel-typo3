plugin.tx_naturalcarousel {
	view {
		# cat=plugin.tx_naturalcarousel/file; type=string; label=Path to template root (FE)
		templateRootPath = EXT:natural_carousel/Resources/Private/Templates/
		# cat=plugin.tx_naturalcarousel/file; type=string; label=Path to template partials (FE)
		partialRootPath = EXT:natural_carousel/Resources/Private/Partials/
		# cat=plugin.tx_naturalcarousel/file; type=string; label=Path to template layouts (FE)
		layoutRootPath = EXT:natural_carousel/Resources/Private/Layouts/
	}
	persistence {
		# cat=plugin.tx_naturalcarousel//a; type=int+; label=Default storage PID
		storagePid =
	}
}