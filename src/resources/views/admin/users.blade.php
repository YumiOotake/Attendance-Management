@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endsection
@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2 class="heading-ttl admin__heading-ttl">users</h2>
            <a href="{{ route('admin.requests.index') }}" class="section__button-requests">
                申請一覧へ
            </a>
            <a href="{{ route('admin.add') }}" class="section__button-requests">
                user登録へ
            </a>
        </div>
        <form class="search-form" action="{{ route('admin.users.index') }}" method="get">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input type="text" name="keyword" class="search-form__item-input" placeholder="お名前を入力してください "
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit" type="submit">検索</button>
                    <a href="{{ route('admin.users.index') }}" class="search-form__button--reset">
                        リセット
                    </a>
                </div>
            </div>
        </form>
        {{-- <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div> --}}
        <div class="attendance__result">
            <table class="attendance-table">
                <thead class="attendance-table__thead">
                    <tr class="attendance-table__row">
                        <th class="attendance-table__header"></th>
                        <th class="attendance-table__header">名前</th>
                        <th class="attendance-table__header">ID</th>
                        <th class="attendance-table__header">メールアドレス</th>
                    </tr>
                </thead>
                <tbody class="attendance-table__tbody">
                    @forelse ($users as $user)
                        <tr class="attendance-table__row">
                            <td class="attendance-table__item">
                                <div class="attendance-table__modal">
                                    <button id="{{ $user->id }}" class="attendance-table__modal-button">詳細</button>
                                </div>
                            </td>
                            <td class="attendance-table__item">{{ $user->name }}</td>
                            <td class="attendance-table__item">{{ $user->login_id }}</td>
                            <td class="attendance-table__item">{{ $user->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="attendance-table__empty">
                                userがいません。
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div> --}}
    </div>
    <div id="user-modal" style="display:none;">
        <button id="modal-close">閉じる</button>
        <table>
            <tbody id="modal-list"></tbody>
        </table>
    </div>
    <script>
        document.querySelectorAll('.attendance-table__modal-button').forEach(button => {
            button.addEventListener('click', () => {
                const user = button.id;

                fetch(`/admin/users/${user}/requests`) //JSの書き方で！
                    .then(res => res.json())
                    .then(requests => {
                        const list = document.getElementById('modal-list');
                        list.innerHTML = '';

                        requests.forEach(request => {

                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${request.reason}</td>
                        <td><a href="/admin/request/${request.id}/edit">編集</a></td>
                        `;
                            list.appendChild(row);
                        });

                        document.getElementById('user-modal').style.display = 'block';
                    });
            });
        });

        document.getElementById('modal-close').addEventListener('click', () => {
            document.getElementById('user-modal').style.display = 'none';
        });
    </script>
@endsection
