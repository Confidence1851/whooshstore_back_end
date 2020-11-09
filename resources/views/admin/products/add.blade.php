@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
<div class="ps-main__wrapper">
    <header class="header--dashboard">
        <div class="header__left">
            <h3>New Product</h3>
            <p>Add new product</p>
        </div>
        <div class="header__center">
            <form class="ps-form--search-bar" action="http://nouthemes.net/html/martfury/admin/index.html" method="get">
                <input class="form-control" type="text" placeholder="Search something" />
                <button><i class="icon-magnifier"></i></button>
            </form>
        </div>
        <div class="header__right"><a class="header__site-link" href="#"><span>View your store</span><i class="icon-exit-right"></i></a></div>
    </header>
    <section class="ps-new-item">
        <form class="ps-form ps-form--new-product" action="http://nouthemes.net/html/martfury/admin/index.html" method="get">
            <div class="ps-form__content">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <figure class="ps-block--form-box">
                            <figcaption>General</figcaption>
                            <div class="ps-block__content">
                                <div class="form-group">
                                    <label>Product Name<sup>*</sup>
                                    </label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter product name..." />
                                </div>
                                <div class="form-group">
                                    <label>Product Summary<sup>*</sup>
                                    </label>
                                    <textarea class="form-control" rows="6" name="details" placeholder="Enter product details..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Regular Price<sup>*</sup>
                                    </label>
                                    <input class="form-control" type="text" name="price" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label>Sale Quantity<sup>*</sup>
                                    </label>
                                    <input class="form-control" type="number" name="quantity" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label>Product Description<sup>*</sup></label>
                                    <textarea id="summernote" rows="6" name="description"></textarea>
                                </div>
                            </div>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <figure class="ps-block--form-box">
                            <figcaption>Product Features</figcaption>
                            <div class="ps-block__content">
                                <div class="form-group">
                                    <label>Percent Off
                                    </label>
                                    <input class="form-control" type="number" name="percent_off" placeholder="Enter product percent off..." />
                                </div>
                                <div class="form-group">
                                    <label>Weight
                                    </label>
                                    <input class="form-control" type="number" name="weight" placeholder="Enter product wright..." />
                                </div>
                                <div class="form-group__content">
                                    <select class="ps-select" title="Size" name="size">
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="XXXL">XXXL</option>
                                    </select>
                                </div>
                                <div class="form-group__content">
                                    <select class="ps-select" title="Type" name="type">
                                        <option value="New">New</option>
                                        <option value="Featured">Featured</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Colors
                                    </label>
                                    <input class="form-control" type="text" name="color" placeholder="colors, separate with comama" />
                                </div>
                                <div class="form-group">
                                    <label>Product Details<sup>*</sup></label>
                                    <textarea id="details" rows="6" name="details"></textarea>
                                </div>
                            </div>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <figure class="ps-block--form-box">
                            <figcaption>Product Images</figcaption>
                            <div class="ps-block__content">
                                <div class="form-group">
                                    <label>Product Thumbnail</label>
                                    <div class="form-group--nest">
                                        <input class="form-control mb-1" type="text" name="image" placeholder="">
                                        <button class="ps-btn ps-btn--sm">Choose</button>
                                    </div>
                                </div>
                                <div class="form-group form-group--nest">
                                    <input class="form-control mb-1" type="text" placeholder="">
                                    <button class="ps-btn ps-btn--sm">Choose</button>
                                </div>
                                <div class="form-group">
                                    <label>Video (optional)
                                    </label>
                                    <input class="form-control" type="text" name="videp" placeholder="Enter video URL" />
                                </div>
                            </div>
                        </figure>
                        <figure class="ps-block--form-box">
                            <figcaption>Inventory</figcaption>
                            <div class="ps-block__content">
                                <div class="form-group">
                                    <label>SKU<sup>*</sup>
                                    </label>
                                    <input class="form-control" type="text" placeholder="" />
                                </div>
                                <div class="form-group form-group--select">
                                    <label>Status
                                    </label>
                                    <div class="form-group__content">
                                        <select class="ps-select" title="Status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <figure class="ps-block--form-box">
                            <figcaption>Meta</figcaption>
                            <div class="ps-block__content">
                                <div class="form-group">
                                    <label>Tags
                                    </label>
                                    <input class="form-control" name="tags" type="text" />
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="ps-form__bottom"><a class="ps-btn ps-btn--black" href="products.html">Back</a>
                <button class="ps-btn ps-btn--gray">Cancel</button>
                <button class="ps-btn">Submit</button>
            </div>
        </form>
    </section>
</div>
@endsection