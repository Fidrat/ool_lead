<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OolongMedia.OolLead',
            'Lead',
            [
                'Lead' => 'list, show, edit'
            ],
            // non-cacheable actions
            [
                'Lead' => 'list, show, edit'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    lead {
                        iconIdentifier = ool_lead-plugin-lead
                        title = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_lead.name
                        description = LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_ool_lead_lead.description
                        tt_content_defValues {
                            CType = list
                            list_type = oollead_lead
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'ool_lead-plugin-lead',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:ool_lead/Resources/Public/Icons/user_plugin_lead.svg']
			);
		
    }
);
