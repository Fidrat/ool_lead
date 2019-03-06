<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OolongMedia.OolLead',
            'Lead',
            'Leads '
        );

        $pluginSignature = str_replace('_', '', 'ool_lead') . '_lead';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:ool_lead/Configuration/FlexForms/flexform_lead.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ool_lead', 'Configuration/TypoScript', 'lead');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_oollead_domain_model_lead', 'EXT:ool_lead/Resources/Private/Language/locallang_csh_tx_oollead_domain_model_lead.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_oollead_domain_model_lead');

    }
);
