<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Messages
    |--------------------------------------------------------------------------
    */
    'api' => [
        'error' => [
            'validation' => 'Ocorreu algum erro na validação dos campos informados.',
            'internal' => 'Ocorreu um erro interno e a equipe técnica já foi notificada.',
            'not' => [
                'found' => 'Não foi encontrado nenhum resultado para sua solicitação.',
            ],
            'endpoint' => [
                'not' => [
                    'found' => 'O endpoint solicitado não foi encontrado.',
                ],
            ],
            'deprecated' => 'O endpoint solicitado foi depreciado.',
            'general' => 'Não foi possível executar esta ação, por favor tente novamente.',
            'upload' => 'Não foi possível efetuar o upload desta imagem, por favor tente novamente.',
            'missing' => [
                'permission' => 'Você não tem permissão para acessar esse recurso.',
            ],
            'rate_limit' => 'Processo cancelado devido a muitas tentativas. Deverá ser solicitado um novo código de verificação.',
            'invalid' => [
                'parameters' => 'Os parâmetros obrigatórios estão ausentes ou são inválidos.',
                'password' => 'A senha informada é inválida, por favor tente novamente.',
                'credentials' => 'As credenciais informadas não corresponde a nenhuma conta.',
                'scope' => 'Esse usuário não possui esse tipo de permissão.',
            ],
            'duplicated_resource' => 'Dados duplicados.',
            'time_limit' => 'Tempo limite excedido.',
            'session' => [
                'invalid' => 'Sessão inválida.',
            ],
            'email' => [
                'invalid' => 'Email deve ser validado.',
            ],
            'store_update' => 'Não foi possível realizar a criação ou atualização.',
            'user' => [
                'not' => [
                    'found' => 'Usuário informado não encontrado.',
                    'follow' => 'Você não é mais um seguidor deste usuário.',
                ],
                'already' => [
                    'follow' => 'Você ja é um seguidor deste usuário.',
                ],
            ],
            'profile' => [
                'already' => [
                    'exists' => 'Já existe um profile para este usuário.',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Messages
    |--------------------------------------------------------------------------
    */
    'notification' => [
        'welcome' => [
            'title' => 'Bem-vinda(o) no Get In!',
            'body' => 'Seu cadastro foi criado com sucesso e estamos felizes de te ver por aqui! 😃'
                . \PHP_EOL
                . 'Aproveite para descobrir novos lugares, fazer reservas online e entrar na fila de forma remota '
                . 'nos restaurantes que escolher ir!',
        ],
    ],
];
