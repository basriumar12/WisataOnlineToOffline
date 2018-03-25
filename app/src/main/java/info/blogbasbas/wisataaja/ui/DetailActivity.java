package info.blogbasbas.wisataaja.ui;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.design.widget.AppBarLayout;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.gson.Gson;
import com.squareup.picasso.Picasso;

import butterknife.BindView;
import butterknife.ButterKnife;
import info.blogbasbas.wisataaja.Constant;
import info.blogbasbas.wisataaja.R;
import info.blogbasbas.wisataaja.model.WisataItem;
import timber.log.Timber;

public class DetailActivity extends AppCompatActivity {

    public static final String PARAMETERTBL = "PARAMETER";
    @BindView(R.id.iv_detail_gambar)
    ImageView ivDetailGambar;
    @BindView(R.id.toolbar)
    Toolbar toolbar;
    @BindView(R.id.toolbar_layout)
    CollapsingToolbarLayout toolbarLayout;
    @BindView(R.id.app_bar)
    AppBarLayout appBar;
    @BindView(R.id.tv_detail_alamat)
    TextView tvDetailAlamat;
    @BindView(R.id.tvEventWisata)
    TextView tvEventWisata;
    @BindView(R.id.tv_detail_deskripsi)
    TextView tvDetailDeskripsi;
    @BindView(R.id.fab)
    FloatingActionButton fab;


    private Gson data = new Gson();
    private WisataItem wisataItem;
    String longWisata, latWisata;
    String getDataIntent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);
        ButterKnife.bind(this);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        getDataIntent = getIntent().getStringExtra(PARAMETERTBL);
        wisataItem = data.fromJson(getDataIntent, WisataItem.class);

        Timber.e("Hasil Data :" + wisataItem.getNamaWisata());
        Timber.e("Hasil Data :" + wisataItem.getGambarWisata());


        getSupportActionBar().setTitle(wisataItem.getNamaWisata());
        tvDetailDeskripsi.setText(wisataItem.getDeksripsiWisata());
        tvDetailAlamat.setText(wisataItem.getAlamatWisata());
        tvEventWisata.setText(wisataItem.getEventWisata());
        Picasso.get().load(Constant.IMG_URL+wisataItem.getGambarWisata())
                .error(R.mipmap.ic_launcher)
                .placeholder(R.mipmap.ic_launcher)
                .into(ivDetailGambar);



        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                route();
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });
    }

    private void route() {

        try {

            longWisata = wisataItem.getLongitudeWisata();
            latWisata = wisataItem.getLatitudeWisata();

            Uri gmmIntentUri = Uri.parse("google.navigation:q=" + latWisata + "," + longWisata + "");
            Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
            mapIntent.setPackage("com.google.android.apps.maps");
            startActivity(mapIntent);
        } catch (Exception e){
            Timber.e("Error Gak Maps App" +e.getMessage());

        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        int i = item.getItemId();
        if (i == android.R.id.home) {
            onBackPressed();
        }
        return super.onOptionsItemSelected(item);

    }
}
