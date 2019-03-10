<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import',
        'label' => 'run_start_time',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'enablecolumns' => [
        ],
        'searchFields' => 'error,log,report_data',
        'iconfile' => 'EXT:ool_lead/Resources/Public/Icons/tx_oollead_domain_model_import.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, run_start_time, run_end_time, finished_on_error, error, log, report_data',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, run_start_time, run_end_time, finished_on_error, error, log, report_data'],
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
                'foreign_table' => 'tx_oollead_domain_model_import',
                'foreign_table_where' => 'AND {#tx_oollead_domain_model_import}.{#pid}=###CURRENT_PID### AND {#tx_oollead_domain_model_import}.{#sys_language_uid} IN (-1,0)',
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

        'run_start_time' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.run_start_time',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'run_end_time' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.run_end_time',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'finished_on_error' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.finished_on_error',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'error' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.error',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'log' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.log',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'report_data' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ool_lead/Resources/Private/Language/locallang_db.xlf:tx_oollead_domain_model_import.report_data',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
    
    ],
];
