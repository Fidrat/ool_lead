<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead',
        'label' => 'date',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'email_used,submission_id,url_source,user_ip',
        'iconfile' => 'EXT:ool_lead/Resources/Public/Icons/tx_oollead_domain_model_lead.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, date, email_used, submission_id, url_source, user_ip, end_user, lead_mover',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, date, email_used, submission_id, url_source, user_ip, end_user, lead_mover, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_oollead_domain_model_lead',
                'foreign_table_where' => 'AND {#tx_oollead_domain_model_lead}.{#pid}=###CURRENT_PID### AND {#tx_oollead_domain_model_lead}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'email_used' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.email_used',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'submission_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.submission_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'url_source' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.url_source',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'user_ip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.user_ip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'end_user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.end_user',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_oollead_domain_model_enduser',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'lead_mover' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_lead.lead_mover',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_oollead_domain_model_leadmover',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
    
    ],
];
