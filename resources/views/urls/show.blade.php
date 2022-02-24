@extends('layout.app')
@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tbody><tr>
                        <td>ID</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $url->name }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $url->created_at }}</td>
                    </tr>
                    </tbody></table>
            </div>
            <h2 class="mt-5 mb-3">Проверки</h2>
            <form method="post" action="https://php-l3-page-analyzer.herokuapp.com/urls/1/checks">
                <input type="hidden" name="_token" value="V1c9yS0qkLWLe8vGMMh7Z8uM6B2PxoFIuJfow5vb">            <input type="submit" class="btn btn-primary" value="Запустить проверку">
            </form>
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                <tr>
                    <td>127</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-23 11:31:00</td>
                </tr>
                <tr>
                    <td>124</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-22 10:38:51</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>200</td>
                    <td></td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-20 19:29:22</td>
                </tr>
                <tr>
                    <td>122</td>
                    <td>200</td>
                    <td></td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-20 18:26:26</td>
                </tr>
                <tr>
                    <td>117</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-17 19:34:43</td>
                </tr>
                <tr>
                    <td>116</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-17 19:34:41</td>
                </tr>
                <tr>
                    <td>115</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-17 19:34:39</td>
                </tr>
                <tr>
                    <td>114</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-17 18:59:33</td>
                </tr>
                <tr>
                    <td>113</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-17 18:59:28</td>
                </tr>
                <tr>
                    <td>101</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-15 13:46:30</td>
                </tr>
                <tr>
                    <td>89</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-11 19:38:54</td>
                </tr>
                <tr>
                    <td>86</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-10 16:01:58</td>
                </tr>
                <tr>
                    <td>79</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-06 14:50:39</td>
                </tr>
                <tr>
                    <td>75</td>
                    <td>200</td>
                    <td></td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-04 16:32:14</td>
                </tr>
                <tr>
                    <td>74</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-03 14:17:57</td>
                </tr>
                <tr>
                    <td>52</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-26 19:36:45</td>
                </tr>
                <tr>
                    <td>47</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-24 16:41:29</td>
                </tr>
                <tr>
                    <td>45</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:55</td>
                </tr>
                <tr>
                    <td>44</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:54</td>
                </tr>
                <tr>
                    <td>43</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:54</td>
                </tr>
                <tr>
                    <td>42</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:53</td>
                </tr>
                <tr>
                    <td>41</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:51</td>
                </tr>
                <tr>
                    <td>40</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:49</td>
                </tr>
                <tr>
                    <td>39</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:47</td>
                </tr>
                <tr>
                    <td>38</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:45</td>
                </tr>
                <tr>
                    <td>37</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-23 12:50:42</td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-22 13:39:17</td>
                </tr>
                <tr>
                    <td>30</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-20 21:31:23</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-20 07:51:03</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-20 07:02:37</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-19 03:50:53</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-01-18 04:58:00</td>
                </tr>
                </tbody></table>
        </div>
    </main>
@endsection
