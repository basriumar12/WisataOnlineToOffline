package info.blogbasbas.wisataaja;

import android.app.Application;
import android.util.Log;

import org.greenrobot.greendao.database.Database;

import info.blogbasbas.wisataaja.db.facade.Facade;
import info.blogbasbas.wisataaja.db.facade.FacadeOpenHelper;
import info.blogbasbas.wisataaja.model.DaoMaster;
import info.blogbasbas.wisataaja.model.DaoSession;
import timber.log.Timber;

/**
 * Created by User on 25/03/2018.
 */

public class BaseApp extends Application {
    private static final boolean ENCRYPTED = false;
    private static DaoSession daoSession;

    @Override
    public void onCreate() {
        super.onCreate();
        Timber.plant(new Timber.DebugTree());
        String databaseName = "mantan-terindah";
        FacadeOpenHelper helper = new FacadeOpenHelper(this, databaseName);

        String password = "y=m+c^";

        Timber.e("database name : %s", databaseName);
        Log.e("database name : %s", databaseName);

        Database db = ENCRYPTED ? helper.getEncryptedWritableDb(password)
                : helper.getWritableDb();

        daoSession = new DaoMaster(db).newSession();

        Facade.init(daoSession);


    }
    public static DaoSession getDaoSession() {
        return daoSession;
    }
}
