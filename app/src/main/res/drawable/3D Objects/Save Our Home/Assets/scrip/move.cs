using UnityEngine;
using UnityStandardAssets.CrossPlatformInput;

public class move : MonoBehaviour {
    float dir;
    float dur;
    Rigidbody2D rb;

    void Start()
    {
        rb = GetComponent<Rigidbody2D>();
    }
		

	
	// Update is called once per frame
	void Update () {
    	dir = CrossPlatformInputManager.GetAxis("Horizontal");
        rb.velocity = new Vector2 (dir * 10, 0);

    	dur = CrossPlatformInputManager.GetAxis("Vertical");
     	rb.velocity = new Vector2(dur * 0, 10);
    }
}
