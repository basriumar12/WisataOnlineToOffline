package info.blogbasbas.wisataaja.model;

import org.greenrobot.greendao.annotation.Entity;
import org.greenrobot.greendao.annotation.Id;
import org.greenrobot.greendao.annotation.Index;
import org.greenrobot.greendao.annotation.Generated;

/**
 * Created by User on 25/03/2018.
 */
@Entity(nameInDb = "HomeTbl",
        indexes = {@Index(value = "id", unique = true)})

public class HomeTbl {
    @Id (autoincrement = true)
    Long id ;
    String jendela, pintu ;
@Generated(hash = 775871494)
public HomeTbl(Long id, String jendela, String pintu) {
    this.id = id;
    this.jendela = jendela;
    this.pintu = pintu;
}
@Generated(hash = 1182566622)
public HomeTbl() {
}
public Long getId() {
    return this.id;
}
public void setId(Long id) {
    this.id = id;
}
public String getJendela() {
    return this.jendela;
}
public void setJendela(String jendela) {
    this.jendela = jendela;
}
public String getPintu() {
    return this.pintu;
}
public void setPintu(String pintu) {
    this.pintu = pintu;
}
}
