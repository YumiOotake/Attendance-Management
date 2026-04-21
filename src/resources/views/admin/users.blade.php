@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endsection
@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2 class="heading-ttl admin__heading-ttl">users</h2>
            <a href="{{ route('index') }}" class="section__button-requests">
                申請一覧へ
            </a>
            <a href="{{ route('admin.add') }}" class="section__button-requests">
                user登録へ
            </a>
        </div>
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input type="text" name="keyword" class="search-form__item-input" placeholder="お名前を入力してください "
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit" type="submit">検索</button>
                    <a href="{{ route('items.index') }}" class="search-form__button--reset">
                        リセット
                    </a>
                </div>
            </div>
        </form>
        <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
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
                                <div class="attendance-table__request">
                                    <a href="{{ route('admin.requestEdit') }}"
                                        class="attendance-table__request-button">編集</a>
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
        <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
