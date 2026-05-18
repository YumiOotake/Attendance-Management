@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/requests.css') }}">
@endsection
@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2 class="heading-ttl admin__heading-ttl">requests</h2>
            <a href="{{ route('admin.users.index') }}" class="section__button-user">
                ユーザー一覧へ
            </a>
            <a href="{{ route('admin.add') }}" class="section__button-requests">
                user登録へ
            </a>
        </div>
        <form class="search-form" action="{{ route('admin.requests.index') }}" method="get">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input type="text" name="keyword" class="search-form__item-input" placeholder="お名前を入力してください "
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-form__item">
                    <select name="attendance_requests_id" class="search-form__item-input">
                        <option value="">申請種類</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>承認待ち</option>
                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>承認済み</option>
                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>却下ずみ</option>
                    </select>
                </div>
                {{-- <div class="search-form__button">
                    <button class="search-form__button--submit" type="submit">検索</button>
                    <a href="{{ route('admin.requests.index') }}" class="search-form__button--reset">
                        リセット
                    </a>
                </div> --}}
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
                        <th class="attendance-table__header">理由</th>
                        <th class="attendance-table__header">状態</th>
                    </tr>
                </thead>
                <tbody class="attendance-table__tbody">
                    @forelse ($attendanceRequests as $attendanceRequest)
                        <tr class="attendance-table__row">
                            <td class="attendance-table__item">
                                <div class="attendance-table__request">
                                    <a href="{{ route('admin.request.edit', $attendanceRequest) }}"
                                        class="attendance-table__request-button">修正</a>
                                </div>
                            </td>
                            <td class="attendance-table__item">{{ $attendanceRequest->user->name }}</td>
                            <td class="attendance-table__item">{{ $attendanceRequest->reason }}</td>
                            <td class="attendance-table__item">{{ $attendanceRequest->status_label }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="attendance-table__empty">
                                申請記録がありません。
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
@endsection
