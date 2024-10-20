<table style="text-align: left;border-collapse: collapse; border: 1px solid #c2c2c2;">
    <tbody>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Юридическое лицо</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $ur ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">ИНН</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $inn ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">ОГРН</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $ogrn ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Юридический адрес</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $uradr ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Банк</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $bank ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">БИК</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $bik ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Расчетный счёт</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $chet ?? '—' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Нужна доставка</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $need_delivery ?? 'Да' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Адрес доставки</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $delivery ?? '—' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Имя</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $name }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Номер телефона</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $phone }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Адрес электронной почты</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $email }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Комментарий</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $comment ?? '—' }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #c2c2c2;padding: 6px;">Нужно созвониться</td>
            <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $need_call ?? 'Да' }}</td>
        </tr>
    </tbody>
</table>

<h3>Продукты</h3>
<table style="text-align: left;border-collapse: collapse; border: 1px solid #c2c2c2;">
    <thead>
        <tr>
            <th style="border: 1px solid #c2c2c2;padding: 6px;">ID</th>
            <th style="border: 1px solid #c2c2c2;padding: 6px;">Название</th>
            <th style="border: 1px solid #c2c2c2;padding: 6px;">Кол-во</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td style="border: 1px solid #c2c2c2;padding: 6px;font-weight: bold;">{{ $item['product']->id }}</td>
                <td style="border: 1px solid #c2c2c2;padding: 6px;">{{ $item['product']->name }}</td>
                <td style="border: 1px solid #c2c2c2;padding: 6px;">{{ $item['amount'] }} шт.</td>
            </tr>
        @endforeach
    </tbody>
</table>
