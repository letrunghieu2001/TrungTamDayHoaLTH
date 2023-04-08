@extends('layouts.home.app')

@section('title')
    Cân bằng phản ứng
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h1 style="text-align:center">Cân bằng phương trình phản ứng</h1>
            <form onsubmit="event.preventDefault(); doBalance();">
                <div class="col-md-12">
                    <input type="text" autocomplete="off" id="inputFormula"
                        placeholder="Nhập phương trình chưa cân bằng vào đây (VD: H2 + O2 = H2O)" data-listener-added_bf758eae="true"
                        style="width: 100%" />
                </div>
                <div class="col-md-12"
                    style="display: flex; align-items: center; justify-content: center; margin-top: 20px">
                    <button type="submit" class="btn btn-primary" style="margin-right: 20px">Cân bằng</button>
                    <button type="button" onclick="doRandom();" class="btn btn-warning">Phương trình ngẫu nhiên</button>
                </div>
                <div class="col-md-12">
                    <h3>Kết quả: </h3>
                    <output id="balanced" for="inputFormula"
                        style="font-family:serif; font-size:150%; line-height:1.6;"></output><output id="message"
                        for="inputFormula"></output>
                    <output for="inputFormula"><code id="codeOutput">&nbsp;</code></output>
                </div>
            </form>
            <div class="col-md-12">
                <h4>Hướng dẫn sử dụng </h4>
                <form xmlns="http://www.w3.org/1999/xhtml" action="#" method="get" onsubmit="return false;">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Hướng dẫn &amp; demo</th>
                                <th scope="col">Phương trình phải nhập</th>
                                <th scope="col">Phương trình thực tế</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('H2 + O2 = H2O');">Nhập phương trình nhập dưới dạng dấu '='</a></td>
                                <td><code>H2 + O2 = <strong>H2O</strong></code></td>
                                <td>H<sub>2</sub> + O<sub>2</sub><span class="rightarrow"> → </span>H<sub>2</sub>O</td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('Mg(OH)2 = MgO + H2O');">Nhập nhóm</a></td>
                                <td><code>Mg<strong>(OH)</strong>2 = MgO + H2O</code></td>
                                <td>Mg(OH)<sub>2</sub><span class="rightarrow"> → </span>MgO + H<sub>2</sub>O</td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('H^+ + CO3^2- = H2O + CO2');">Nhập Ion phải kèm ký hiệu mũ</a></td>
                                <td><code>H<strong>^+</strong> + CO3<strong>^2-</strong> = H2O + CO2</code></td>
                                <td>H<sup>+</sup> + CO<sub>3</sub><sup>2−</sup><span class="rightarrow"> →
                                    </span>H<sub>2</sub>O + CO<sub>2</sub></td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('Fe^3+ + e = Fe');">Nhập electron không cần kèm số oxi hóa</a></td>
                                <td><code>Fe^3+ + <strong>e</strong> = Fe</code></td>
                                <td>Fe<sup>3+</sup> + e<sup>−</sup><span class="rightarrow"> → </span>Fe</td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('A3^-+B2^2+=A5B+e');">Chấp nhận phương trình nhập không cần dấu cách</a></td>
                                <td><code>A3^-+B2^2+=A5B+e</code></td>
                                <td>A<sub>3</sub><sup>−</sup> + B<sub>2</sub><sup>2+</sup><span class="rightarrow"> →
                                    </span>A<sub>5</sub>B + e<sup>−</sup></td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('C 3 H 5 ( O H ) 3 + O 2 = H 2 O + C O 2');">Chấp nhận phương trình nhập thừa dấu cách</a></td>
                                <td><code>C 3 H 5 ( O H ) 3 + O 2 = H 2 O + C O 2</code></td>
                                <td>C<sub>3</sub>H<sub>5</sub>(OH)<sub>3</sub> + O<sub>2</sub><span class="rightarrow"> →
                                    </span>H<sub>2</sub>O + CO<sub>2</sub></td>
                            </tr>
                            <tr>
                                <td><a href="#" title="Click to show demo"
                                        onclick="event.preventDefault(); doDemo('Foo^5+ + Bar^3- = FooBar2 + FooBar^-');">Hãy nhập tên viết hoa và thường đúng với CTHH</a></td>
                                <td><code><strong>Foo</strong>^5+ + <strong>Bar</strong>^3- =
                                        <strong>Foo</strong><strong>Bar</strong>2 +
                                        <strong>Foo</strong><strong>Bar</strong>^-</code></td>
                                <td>Foo<sup>5+</sup> + Bar<sup>3−</sup><span class="rightarrow"> → </span>FooBar<sub>2</sub>
                                    + FooBar<sup>−</sup></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/home/balance.js') }}"></script>
@endsection
