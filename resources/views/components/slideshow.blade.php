@if (isHomePage())
    <div class="pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="list-box shadow-lg d-flex align-items-center"
                        style="max-height: 476.15px;overflow: hidden;border-radius: 5px;">
                        <img src="{{ asset('assets/images/homepage-bg-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="purchase-history rounded-lg">
                        <div class="card shadow-lg active">
                            <div class="purchase-history__title">
                                LỊCH SỬ MUA NICK GẦN ĐÂY
                            </div>
                            <div class="purchase-history__body card-body">
                                @foreach ($accounts as $account)
                                    <div class="purchase-history__item p-2 font-bold w-100 mb-2" style="border: 1px solid green; border-radius: 10px;">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $account->user->name }}</strong>
                                            <span>{{ \Carbon\Carbon::parse($account->created_at)->diffForhumans() }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between"><span>Mã số: <a
                                                    href="{{ route('account.show', ['category' => $account->account->category->slug, 'account' => $account->account->uuid]) }}">#{{ $account->account_id }}</a></span>
                                            <span
                                                class="text-danger">{{ number_format($account->price, 0, ',', '.') }}đ</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
