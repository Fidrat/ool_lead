<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OolongMedia.OolLead',
            'Enduser',
            [
                'EndUser' => 'list, show, edit, new, create, delete'
            ],
            // non-cacheable actions
            [
                'EndUser' => 'list, show, edit, new'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OolongMedia.OolLead',
            'Leads',
            [
                'Lead' => 'list, show, edit, new, create, delete'
            ],
            // non-cacheable actions
            [
                'Lead' => 'list, show, edit, new'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OolongMedia.OolLead',
            'Importer',
            [
                'Import' => 'import'
            ],
            // non-cacheable actions
            [
                'Import' => 'import'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    enduser {
                        iconIdentifier = ool_lead-plugin-enduser
                        title = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_enduser.name
                        description = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_enduser.description
                        tt_content_defValues {
                            CType = list
                            list_type = oollead_enduser
                        }
                    }
                    leads {
                        iconIdentifier = ool_lead-plugin-leads
                        title = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_leads.name
                        description = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_leads.description
                        tt_content_defValues {
                            CType = list
                            list_type = oollead_leads
                        }
                    }
                    importer {
                        iconIdentifier = ool_lead-plugin-importer
                        title = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_importer.name
                        description = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_importer.description
                        tt_content_defValues {
                            CType = list
                            list_type = oollead_importer
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'ool_lead-plugin-enduser',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:ool_lead/Resources/Public/Icons/user_plugin_enduser.svg']
			);
		
			$iconRegistry->registerIcon(
				'ool_lead-plugin-leads',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:ool_lead/Resources/Public/Icons/user_plugin_leads.svg']
			);
		
			$iconRegistry->registerIcon(
				'ool_lead-plugin-importer',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:ool_lead/Resources/Public/Icons/user_plugin_importer.svg']
			);
		
    }
);
