<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OolongMedia.OolLead',
            'Enduser',
            'End Users management'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OolongMedia.OolLead',
            'Leads',
            'Leads management'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OolongMedia.OolLead',
            'Importer',
            'Importer'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OolongMedia.OolLead',
            'Gfimporter',
            'GfImporter'
        );

        $pluginSignature = str_replace('_', '', 'ool_lead') . '_gfimporter';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:ool_lead/Configuration/FlexForms/flexform_gfimporter.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ool_lead', 'Configuration/TypoScript', 'lead');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_enduser', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_enduser.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_enduser');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_lead', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_lead.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_lead');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_leadmover', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_leadmover.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_leadmover');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_import', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_import.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_import');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_gfimport', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_gfimport.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_gfimport');

    }
);
