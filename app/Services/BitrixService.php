<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Feedback;
use App\User;

class BitrixService
{
    protected $deliveryTypes = [
        Application::DELIVERY_TYPE_AUTO => 310,
        Application::DELIVERY_TYPE_AIR => 312,
        Application::DELIVERY_TYPE_TRAIN => 314,
        Application::DELIVERY_TYPE_MARINE => 316,
        Application::DELIVERY_TYPE_ALL => 318,
    ];

    protected $activityTypes = [
        1 => 282,
        2 => 284,
        3 => 286,
        4 => 288,
        5 => 290,
        7 => 292,
        8 => 294,
        9 => 296,
        10 => 298,
        11 => 300,
        12 => 302,
        13 => 304,
        14 => 306,
        15 => 308,
    ];

    protected $managerIds = [
        8 => 434,
        9 => 432,
        10 => 428,
        11 => 442,
        12 => 440,
        13 => 436,
        14 => 430,
        15 => 438
    ];

    public $cities = [
        5 => 412,
        2 => 410,
        1 => 414
    ];

    public function createUser(User $user)
    {
        $companies = $this->baseRequest('crm.company.list', [
            'filter' => [
                'TITLE' => $user->company_name
            ]
        ]);

        if(empty($companies['result']))
        {
            $company = $this->baseRequest('crm.company.add', [
                'fields' => [
                    'TITLE' => $user->company_name,
                    'UF_CRM_1712314183343' => $this->activityTypes[$user->activity_id],
                    'ASSIGNED_BY_ID' => $this->managerIds[$user->manager_id],
                    'ADDRESS' => $user->district->name_ru ?? '',
                    'SOURCE_ID' => 'ToTrans',
                ]
            ]);
            $companyId = $company['result'];
        } else {
            $companyId = $companies['result'][0]['ID'];
        }

        $users = $this->baseRequest('crm.contact.list', [
            'filter' => [
                'PHONE' => "+998" . $user->phone
            ]
        ]);

        if (empty($users['result'])) {
            $this->baseRequest('crm.contact.add', [
                'fields' => [
                    'NAME' => $user->name,
                    'PHONE' => [
                        ['VALUE' => "+998" . $user->phone, 'VALUE_TYPE' => 'WORK']
                    ],
                    'EMAIL' => [
                        ['VALUE' => $user->email, 'VALUE_TYPE' => 'WORK']
                    ],
                    'UF_CRM_1712314183343' => $this->activityTypes[$user->activity_id],
                    'ASSIGNED_BY_ID' => $this->managerIds[$user->manager_id],
                    'ADDRESS' => $user->district->name_ru ?? '',
                    'COMPANY_ID' => $companyId,
                    'SOURCE_ID' => 'ToTrans',
                ]
            ]);
        }else{
            $this->baseRequest('crm.contact.update', [
                'id' => $users['result'][0]['ID'],
                'fields' => [
                    'NAME' => $user->name,
                    'PHONE' => [
                        ['VALUE' => "+998" . $user->phone, 'VALUE_TYPE' => 'WORK']
                    ],
                    'EMAIL' => [
                        ['VALUE' => $user->email, 'VALUE_TYPE' => 'WORK']
                    ],
                    'UF_CRM_1712314183343' => $this->activityTypes[$user->activity_id],
                    'ASSIGNED_BY_ID' => $this->managerIds[$user->manager_id],
                    'ADDRESS' => $user->district->name_ru ?? '',
                    'COMPANY_ID' => $companyId,
                    'SOURCE_ID' => 'ToTrans',
                ]
            ]);
        }
    }

    public function createFeedback(Feedback $feedback)
    {
        $contacts = $this->baseRequest('crm.contact.list', [
            'filter' => [
                'PHONE' => "+998" . $feedback->phone
            ]
        ]);

        if(empty($contacts['result'])) {
            $contact = $this->baseRequest('crm.contact.add', [
                'fields' => [
                    'NAME' => $feedback->name,
                    'PHONE' => [
                        ['VALUE' => "+998" . $feedback->phone, 'VALUE_TYPE' => 'WORK']
                    ],
                    'UF_CRM_1712314183343' => $this->activityTypes[$feedback->activity_id],
                    'SOURCE_ID' => 'ToTrans',
                ]
            ]);
            $contactId = $contact['result'];
        } else {
            $contactId = $contacts['result'][0]['ID'];
        }

        $deal = $this->baseRequest('crm.deal.add', [
            'fields' => [
                'CONTACT_ID' => $contactId,
                'SOURCE_ID' => 'Сайт ToTrans калькулятор',
                'CURRENCY_ID' => 'USD',
                'OPPORTUNITY' => Feedback::calculatePrice($feedback),
                'UF_CRM_1712315079793' => $this->deliveryTypes[$feedback->delivery_type],
                'UF_CRM_1709990572889' => $feedback->weight,
                'UF_CRM_1709990549049' => $feedback->volume,
                'UF_CRM_1712659161' => $this->cities[$feedback->pointA->city->id],
                'UF_CRM_1712659280' => $this->cities[$feedback->pointB->city->id],
            ]
        ]);

        $dealId = $deal['result'];

        if($feedback->additional->exists()){
            $this->baseRequest('crm.timeline.comment.add', [
                'fields' => [
                    'ENTITY_ID' => $dealId,
                    'ENTITY_TYPE' => 'deal',
                    'COMMENT' => $feedback->additional->title_ru ?? '',
                ]
            ]);
        }
    }

    public function updateDealStatus($id, $status)
    {
        $this->baseRequest('crm.deal.update', [
            'id' => $id,
            'fields' => [
                'UF_CRM_1712316955098' => $status
            ]
        ]);
    }

    public function updateDealState($id, $state)
    {
        $this->baseRequest('crm.deal.update', [
            'id' => $id,
            'fields' => [
                'UF_CRM_1712317558925' => $state
            ]
        ]);
    }

    public function getDeal($id)
    {
        return $this->baseRequest('crm.deal.get', [
            'id' => $id
        ])['result'];
    }

    public function getContact($id)
    {
        return $this->baseRequest('crm.contact.get', [
            'id' => $id
        ])['result'];
    }

    public function baseRequest($method, $data)
    {
        $endpoint = "https://crm.adnur.org/rest/378/0dgp6l1yqm4mz26d/$method";
        $queryData = http_build_query($data);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $endpoint,
            CURLOPT_POSTFIELDS => $queryData,
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true);
    }
}
