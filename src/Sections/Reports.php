<?php

namespace AmazonMWSAPI\Sections;

use AmazonMWSAPI\Sections\Sections;

class Reports extends Sections
{

    protected static $feedType = "";
    protected static $feedContent = "";
    protected static $versionDate = "2009-01-01";
    private static $overviewUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_Overview.html";
    private static $libraryUpdateUrl = "http://docs.developer.amazonservices.com/en_US/reports/Reports_ClientLibraries.html";
    protected static $dataTypes = [
        "ReportInfo" => [
            "ReportId",
            "ReportType" => [
                "format" => "ReportType"
            ],
            "ReportRequestId",
            "AvailableDate" => [
                "format" => "dateTime"
            ],
            "Acknowledged",
            "AcknowledgedDate" => [
                "format" => "dateTime"
            ]
        ],
        "ReportRequestInfo" => [
            "ReportRequestId",
            "ReportType" => [
                "format" => "ReportType"
            ],
            "StartDate" => [
                "format" => "dateTime"
            ],
            "EndDate" => [
                "format" => "dateTime"
            ],
            "Scheduled" => [
                "validWith" => [
                    "true",
                    "false"
                ]
            ],
            "SubmittedDate" => [
                "format" => "dateTime"
            ],
            "ReportProcessingStatus",
            "GeneratedReportId",
            "StartedProcessingDate" => [
                "format" => "dateTime"
            ],
            "CompletedDate" => [
                "format" => "dateTime"
            ]
        ],
        "ReportSchedule" => [
            "ReportType" => [
                "format" => "dateTime"
            ],
            "Schedule" => [
                "format" => "Schedule"
            ],
            "ScheduledDate" => [
                "format" => "dateTime"
            ]
        ],
        "ReportType" => [
            "validWith" => [
                "_GET_FLAT_FILE_OPEN_LISTINGS_DATA_",
                "_GET_MERCHANT_LISTINGS_ALL_DATA_",
                "_GET_MERCHANT_LISTINGS_DATA_",
                "_GET_MERCHANT_LISTINGS_INACTIVE_DATA_",
                "_GET_MERCHANT_LISTINGS_DATA_BACK_COMPAT_",
                "_GET_MERCHANT_LISTINGS_DATA_LITE_",
                "_GET_MERCHANT_LISTINGS_DATA_LITER_",
                "_GET_MERCHANT_CANCELLED_LISTINGS_DATA_",
                "_GET_CONVERGED_FLAT_FILE_SOLD_LISTINGS_DATA_",
                "_GET_MERCHANT_LISTINGS_DEFECT_DATA_",
                "_GET_PAN_EU_OFFER_STATUS_",
                "_GET_MFN_PAN_EU_OFFER_STATUS_",
                "_GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_",
                "_GET_ORDERS_DATA_",
                "_GET_FLAT_FILE_ORDERS_DATA_",
                "_GET_CONVERGED_FLAT_FILE_ORDER_REPORT_DATA_",
                "_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_",
                "_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_",
                "_GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_",
                "_GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_",
                "_GET_FLAT_FILE_PENDING_ORDERS_DATA_",
                "_GET_PENDING_ORDERS_DATA_",
                "_GET_CONVERGED_FLAT_FILE_PENDING_ORDERS_DATA_",
                "_GET_SELLER_FEEDBACK_DATA_",
                "_GET_V1_SELLER_PERFORMANCE_REPORT_",
                "_GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_",
                "_GET_V2_SETTLEMENT_REPORT_DATA_XML_",
                "_GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_V2_",
                "_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_",
                "_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_",
                "_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_",
                "_GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_",
                "_GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_",
                "_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_SALES_DATA_",
                "_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_PROMOTION_DATA_",
                "_GET_FBA_FULFILLMENT_CUSTOMER_TAXES_DATA_",
                "_GET_AFN_INVENTORY_DATA_",
                "_GET_AFN_INVENTORY_DATA_BY_COUNTRY_",
                "_GET_FBA_FULFILLMENT_CURRENT_INVENTORY_DATA_",
                "_GET_FBA_FULFILLMENT_MONTHLY_INVENTORY_DATA_",
                "_GET_FBA_FULFILLMENT_INVENTOY_RECEIPTS_DATA_",
                "_GET_RESERVED_INVENTORY_DATA_",
                "_GET_FBA_FULFILLMENT_INVENTORY_SUMMARY_DATA_",
                "_GET_FBA_FULFILLMENT_INVENTORY_ADJUSTMENTS_DATA_",
                "_GET_FBA_FULFILLMENT_INVENTORY_HEALTH_DATA_",
                "_GET_FBA_MYI_UNSUPPRESSED_INVENTORY_DATA_",
                "_GET_FBA_MYI_ALL_INVENTORY_DATA_",
                "_GET_RESTOCK_INVENTORY_RECOMMENDATIONS_REPORT_",
                "_GET_FBA_FULFILLMENT_INBOUND_NONCOMPLIANCE_DATA_",
                "_GET_STRANDED_INVENTORY_UI_DATA_",
                "_GET_STRANDED_INVENTORY_LOADER_DATA_",
                "_GET_FBA_INVENTORY_AGED_DATA_",
                "_GET_EXCESS_INVENTORY_DATA_",
                "_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_",
                "_GET_FBA_REIMBURSEMENTS_DATA_",
                "_GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA_",
                "_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA_",
                "_GET_FBA_RECOMMENDED_REMOVAL_DATA_",
                "_GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA_",
                "_GET_FBA_FULFILLMENT_REMOVAL_SHIPMENT_DETAIL_DATA_",
                "_GET_FLAT_FILE_SALES_TAX_DATA_",
                "_SC_VAT_TAX_REPORT_",
                "_GET_VAT_TRANSACTION_DATA_",
                "_GET_XML_BROWSE_TREE_DATA_"
            ]
        ],
        "Schedule" => [
            "validWith" => [
                "_15_MINUTES_",
                "_30_MINUTES_",
                "_1_HOUR_",
                "_2_HOURS_",
                "_4_HOURS_",
                "_8_HOURS_",
                "_12_HOURS_",
                "_1_DAY_",
                "_2_DAYS_",
                "_72_HOURS_",
                "_1_WEEK_",
                "_14_DAYS_",
                "_15_DAYS_",
                "_30_DAYS_",
                "_NEVER_"
            ]
        ]
    ];

}